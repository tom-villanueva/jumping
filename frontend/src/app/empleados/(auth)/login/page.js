'use client'

import Button from '@/components/Button'
import Input from '@/components/Input'
import InputError from '@/components/InputError'
import Label from '@/components/Label'
import Link from 'next/link'
import { useAuth } from '@/hooks/auth-empleados'
import { useEffect, useState } from 'react'
import { useRouter } from 'next/navigation'
import AuthSessionStatus from '@/app/(auth)/AuthSessionStatus'

const Login = () => {
  const router = useRouter()

  const { login } = useAuth({
    middleware: 'guest',
    redirectIfAuthenticated: '/empleados/dashboard',
  })

  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [shouldRemember, setShouldRemember] = useState(false)
  const [errors, setErrors] = useState([])
  const [status, setStatus] = useState(null)

  useEffect(() => {
    if (router.reset?.length > 0 && errors.length === 0) {
      setStatus(atob(router.reset))
    } else {
      setStatus(null)
    }
  })

  const submitForm = async event => {
    event.preventDefault()

    login({
      email,
      password,
      remember: shouldRemember,
      setErrors,
      setStatus,
    })
  }

  return (
    <>
      <AuthSessionStatus className="mb-4" status={status} />
      <form onSubmit={submitForm}>
        {/* Email Address */}
        <div>
          <Label htmlFor="email">Email</Label>

          <Input
            id="email"
            type="email"
            value={email}
            className="mt-1 block w-full"
            onChange={event => setEmail(event.target.value)}
            required
            autoFocus
          />

          <InputError messages={errors.email} className="mt-2" />
        </div>

        {/* Password */}
        <div className="mt-4">
          <Label htmlFor="password">Contraseña</Label>

          <Input
            id="password"
            type="password"
            value={password}
            className="mt-1 block w-full"
            onChange={event => setPassword(event.target.value)}
            required
            autoComplete="current-password"
          />

          <InputError messages={errors.password} className="mt-2" />
        </div>

        {/* Remember Me */}
        <div className="mt-4 block">
          <label htmlFor="remember_me" className="inline-flex items-center">
            <input
              id="remember_me"
              type="checkbox"
              name="remember"
              className="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
              onChange={event => setShouldRemember(event.target.checked)}
            />

            <span className="ml-2 text-sm text-gray-600">Recuérdame</span>
          </label>
        </div>

        <div className="mt-4 flex items-center justify-end">
          <Link
            href="/empleados/forgot-password"
            className="text-sm text-gray-600 underline hover:text-gray-900">
            ¿Olvidaste la contraseña?
          </Link>

          <Button className="ml-3">Iniciar sesión</Button>
        </div>
      </form>
    </>
  )
}

export default Login
