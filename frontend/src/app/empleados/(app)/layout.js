'use client'

import { useAuth } from '@/hooks/auth-empleados'
import Navigation from '@/app/empleados/(app)/Navigation'
import Loading from '@/app/(app)/Loading'

const AppLayout = ({ children, header }) => {
  const { user } = useAuth({ middleware: 'auth' })

  if (!user) {
    return <Loading />
  }

  return (
    <div className="min-h-screen bg-slate-900">
      <Navigation user={user} />

      <main>{children}</main>
    </div>
  )
}

export default AppLayout
