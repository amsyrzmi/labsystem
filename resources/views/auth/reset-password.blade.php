<x-layout>
<div class="min-h-[calc(100vh-0px)] flex flex-col md:flex-row">
    <!-- LEFT: Reset Password form -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-12">
      <div class="w-full max-w-md h-full md:h-auto bg-white/5 backdrop-blur-sm rounded-2xl shadow-lg p-8 md:p-10 flex flex-col justify-center">
        <header class="mb-6">
          <h1 class="text-3xl font-bold tracking-tight">Reset password</h1>
          <p class="text-sm mt-1 text-[--muted]">Enter your new password</p>
        </header>

        <form action="{{ route('password.update') }}" method="POST" class="space-y-5" novalidate>
          @csrf

          <input type="hidden" name="token" value="{{ $token }}">
          <input type="hidden" name="email" value="{{ $email }}">

          <div>
            <label for="email" class="block text-sm font-medium mb-2">Email</label>
            <input id="email" type="email" value="{{ $email }}" disabled
              class="block w-full rounded-xl border border-transparent bg-white/6 px-4 py-3 text-[--muted] cursor-not-allowed" />
          </div>

          <div>
            <label for="password" class="block text-sm font-medium mb-2">New Password</label>
            <input id="password" name="password" type="password" required
              class="block w-full rounded-xl border border-transparent bg-white/6 px-4 py-3 placeholder:text-[--muted] focus:outline-none focus:ring-2 focus:ring-[--accent] focus:border-transparent"
              placeholder="Choose a strong password" />
          </div>

          <div>
            <label for="password_confirmation" class="block text-sm font-medium mb-2">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
              class="block w-full rounded-xl border border-transparent bg-white/6 px-4 py-3 placeholder:text-[--muted] focus:outline-none focus:ring-2 focus:ring-[--accent] focus:border-transparent"
              placeholder="Repeat your password" />
          </div>

          <div>
            <button type="submit"
              class="w-full rounded-xl py-3 font-semibold text-[--nav-bg] bg-[--accent] hover:opacity-95 focus:outline-none focus:ring-2 focus:ring-[--link-hover]">
              Reset Password
            </button>
          </div>

          <div class="text-center text-sm text-[--muted]">
            Remember your password?
            <a href="{{ route('show.login') }}" class="nav-link">Back to login</a>
          </div>

          @if($errors->any())
            <div class="mt-4">
              <ul class="list-disc list-inside text-sm text-red-600">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </form>
      </div>
    </div>

    <!-- RIGHT: Decorative panel -->
    <aside class="hidden md:flex md:w-1/2 items-center justify-center p-8"
      style="background: transparent;">
      <div class="w-full h-full rounded-2xl flex flex-col items-center justify-center">
        <div class="select-none" style="color: white;">
          made by NexusSphere
        </div>
        <div class="text-7xl font-extrabold select-none" style="color: white;">
          LabCore
        </div>
      </div>
    </aside>
  </div>
</x-layout>