'use client'

import { useAuth } from '@/hooks/auth'
import Navigation from '@/app/(app)/Navigation'
import Loading from '@/app/(app)/Loading'
import { SWRConfig } from 'swr'
import { fetcher } from '@/lib/utils'

const AppLayout = ({ children, header }) => {
  const { user } = useAuth({ middleware: 'auth' })

  if (!user) {
    return <Loading />
  }

  return (
    <div className="min-h-screen bg-gray-100">
      <Navigation user={user} />

      <SWRConfig
        value={{
          fetcher: fetcher,
        }}>
        <main>{children}</main>
      </SWRConfig>
    </div>
  )
}

export default AppLayout
