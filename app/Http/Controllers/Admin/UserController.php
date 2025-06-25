<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->whereNull('deleted_at')->orderBy('id', 'ASC')->paginate(5);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Đã thêm người dùng thành công!');
    }

    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,user',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'updated_at' => now(),
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $id)->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Đã cập nhật người dùng thành công!');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->update([
            'deleted_at' => now()
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Đã chuyển người dùng vào thùng rác!');
    }

    public function trash()
    {
        $users = DB::table('users')->whereNotNull('deleted_at')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.users.trash', compact('users'));
    }

    public function restore($id)
    {
        DB::table('users')->where('id', $id)->update([
            'deleted_at' => null
        ]);

        return redirect()->route('admin.users.trash')->with('success', 'Khôi phục thành công!');
    }

    public function forceDelete($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('admin.users.trash')->with('success', 'Đã xoá vĩnh viễn!');
    }

    // Login, Register, Forgot Password, Logout

    // Hiển thị form đăng nhập
    public function login()
    {
        if (Auth::check()) {
            return redirect()->intended('/dashboard');
        }
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function loginpost(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('ad/dashboard');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ])->onlyInput('email');
    }

    // Xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Hiển thị form quên mật khẩu
    public function forgotpass()
    {
        return view('auth.forgotpass');
    }

    // Xử lý gửi mật khẩu mới qua email
    public function forgotpasspost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email không tồn tại.']);
        }

        $newPassword = Str::random(8);
        $user->password = Hash::make($newPassword);
        $user->save();

        Mail::send([], [], function ($message) use ($user, $newPassword) {
            $message->to($user->email)
                ->subject('Khôi phục mật khẩu')
                ->text('Mật khẩu mới của bạn là: ' . $newPassword);
        });

        return back()->with('status', 'Mật khẩu mới đã được gửi vào email của bạn.');
    }


    // Hiển thị form đổi mật khẩu
    public function showChangePasswordForm()
    {
        return view('auth.changepass');
    }

    // Xử lý đổi mật khẩu
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('status', 'Đổi mật khẩu thành công.');
    }
    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký người dùng mới
    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->fullname,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 0, 
        ]);

        Auth::login($user);

        return redirect('ad/dashboard')->with('status', 'Đăng ký thành công, bạn đã đăng nhập!');
    }
}
