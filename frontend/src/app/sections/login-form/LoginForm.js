import React from 'react'

export default function LoginForm() {
  return (
    <div className="flex flex-col items-center justify-center bg-hero-image bg-cover bg-center py-6 grayscale-[40%]">
      <div className="flex w-[90%] flex-col items-center rounded-sm bg-black/60 sm:w-4/6">
        <div className="flex min-h-full w-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
          <div className="sm:mx-auto sm:w-full sm:max-w-sm">
            <img
              alt="Your Company"
              src="/logo-jumping.png"
              className="mx-auto h-16 w-auto"
            />
            <h2 className="mt-10 text-center font-montserrat text-xl font-bold leading-9 tracking-widest text-white">
              INGRESA A TU CUENTA
            </h2>
          </div>

          <div className="mt-10 sm:mx-auto sm:w-full sm:max-w-md">
            <form action="#" method="POST" className="space-y-6">
              <div>
                <label
                  htmlFor="email"
                  className="block text-sm font-medium leading-6 text-white">
                  Email address
                </label>
                <div className="mt-2">
                  <input
                    id="email"
                    name="email"
                    type="email"
                    required
                    autoComplete="email"
                    className="block w-full rounded-md border-0 bg-transparent py-1.5 text-white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6"
                  />
                </div>
              </div>

              <div>
                <div className="flex items-center justify-between">
                  <label
                    htmlFor="password"
                    className="block text-sm font-medium leading-6 text-white">
                    Password
                  </label>
                  <div className="text-sm">
                    <a
                      href="#"
                      className="font-semibold text-red-600 hover:text-red-500">
                      Forgot password?
                    </a>
                  </div>
                </div>
                <div className="mt-2">
                  <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autoComplete="current-password"
                    className="block w-full rounded-md border-0 bg-transparent py-1.5 text-white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6"
                  />
                </div>
              </div>

              <div className="flex items-center justify-center">
                <button
                  type="submit"
                  className="rounded-full bg-red-600 px-10 py-2 font-montserrat font-bold tracking-widest transition-all duration-75 ease-in hover:bg-red-800">
                  INGRESAR
                </button>
              </div>
            </form>

            <p className="mt-10 text-center text-sm font-thin text-white">
              No eres miembro?{' '}
              <a
                href="#"
                className="font-semibold leading-6 text-red-600 hover:text-red-500">
                Registrate
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  )
}
