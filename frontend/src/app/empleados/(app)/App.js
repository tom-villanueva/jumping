'use client'

import { useAuth } from '@/hooks/auth-empleados'
import Navigation from '@/app/empleados/(app)/Navigation'
import Loading from '@/app/(app)/Loading'
import { SWRConfig } from 'swr'
import { fetcher } from '@/lib/utils'

const App = ({ children }) => {
  const { user, logout } = useAuth({ middleware: 'auth' })

  if (!user) {
    return <Loading />
  }

  return (
    <div>
      <Navigation user={user} logout={logout} />

      <SWRConfig
        value={{
          fetcher: fetcher,
        }}>
        <main>{children}</main>
      </SWRConfig>
    </div>
  )
}

export default App
