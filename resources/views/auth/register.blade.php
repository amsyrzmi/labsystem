<x-layout>
    <div class="min-h-[calc(100vh-0px)] flex flex-col md:flex-row">
    <!-- LEFT: Register form -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-12">
      <div class="w-full max-w-md h-full md:h-auto bg-white/5 backdrop-blur-sm rounded-2xl shadow-lg p-8 md:p-10 flex flex-col justify-center">
        <header class="mb-6">
          <h1 class="text-3xl font-bold tracking-tight">Create account</h1>
          <p class="text-sm mt-1 text-[--muted]">Sign up for LabCore</p>
        </header>

        <form action="{{ route('register') }}" method="POST" class="space-y-5" novalidate>
          @csrf

          <div>
            <label 
                for="name" class="block text-sm font-medium mb-2">

                Full name</label>
            <input 
                id="name" name="name" type="text" value="{{ old('name') }}" required

              class="block w-full rounded-xl border border-transparent bg-white/6 px-4 py-3 placeholder:text-[--muted] focus:outline-none focus:ring-2 focus:ring-[--accent] focus:border-transparent"
              placeholder="Ariffin Mateko" />
          </div>

          <div>
            <label 
                for="email" class="block text-sm font-medium mb-2">

                Email</label>
            <input 
                id="email" name="email" type="email" value="{{ old('email') }}" required

              class="block w-full rounded-xl border border-transparent bg-white/6 px-4 py-3 placeholder:text-[--muted] focus:outline-none focus:ring-2 focus:ring-[--accent] focus:border-transparent"
              placeholder="you@Nexus.com" />
          </div>

          <div x-data="{ role: 'teacher' }">
            <label class="block text-sm font-medium mb-2">Role</label>
            <div class="grid grid-cols-2 gap-3">
                <!-- Teacher -->
                <label class="cursor-pointer">
                <input 
                    type="radio" name="role" value="teacher" x-model="role" class="sr-only" />

                <div
                    class="w-full text-center rounded-lg py-3 border transition-all duration-200 font-medium"
                    :class="role === 'teacher'
                    ? 'bg-white text-black border-[--accent]'
                    : 'bg-white/5 text-white hover:bg-white/10 border-transparent'">
                    Teacher
                </div>
                </label>

                <!-- Lab Assistant -->
                <label class="cursor-pointer">
                <input 
                    type="radio" name="role" value="lab_assistant" x-model="role" class="sr-only" />

                <div
                    class="w-full text-center rounded-lg py-3 border transition-all duration-200 font-medium"
                    :class="role === 'lab_assistant'
                    ? 'bg-white text-black border-[--accent]'
                    : 'bg-white/5 text-white hover:bg-white/10 border-transparent'">
                    Lab Assistant
                </div>
                </label>
            </div>
            </div>

            <script src="//unpkg.com/alpinejs" defer></script>


          <div>
            <label 
                for="password" class="block text-sm font-medium mb-2">Password</label>

            <input 
                id="password" name="password" type="password" required

              class="block w-full rounded-xl border border-transparent bg-white/6 px-4 py-3 placeholder:text-[--muted] focus:outline-none focus:ring-2 focus:ring-[--accent] focus:border-transparent"
              placeholder="Choose a strong password" />
          </div>

          <div>
            <label 
                for="password_confirmation" class="block text-sm font-medium mb-2">Confirm password</label>

            <input 
                id="password_confirmation" name="password_confirmation" type="password" required

              class="block w-full rounded-xl border border-transparent bg-white/6 px-4 py-3 placeholder:text-[--muted] focus:outline-none focus:ring-2 focus:ring-[--accent] focus:border-transparent"
              placeholder="Repeat password" />
          </div>

          <div>
            <button type="submit"
              class="w-full rounded-xl py-3 font-semibold text-[--nav-bg] bg-[--accent] hover:opacity-95 focus:outline-none focus:ring-2 focus:ring-[--link-hover]">
              Create account
            </button>
          </div>

          <div class="text-center text-sm text-[--muted]">
            Already have an account?
            <a href="{{ route('show.login') }}" class="nav-link">Sign in</a>
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

    <!-- RIGHT: Decorative panel (hidden on small screens) -->
    <aside class="hidden md:flex md:w-1/2 items-center justify-center p-8"
      style="background: transparent;">
      <!-- full-height card look -->
      <div class="w-full h-full rounded-2xl flex flex-col items-center justify-center">
        <!-- Large decorative text — low opacity to be subtle -->
        <div class=" select-none" style="color: white;">
          made by NexusSphere
        </div>
        <div class="text-7xl font-extrabold select-none" style="color: white;">
          LabCore
        </div>
      </div>
    </aside>
  </div>
</x-layout>