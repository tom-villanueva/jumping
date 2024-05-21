'use client'

import { Button } from '@/components/ui/button'
import { FrownIcon } from 'lucide-react'
import { useEffect } from 'react'

export default function Error({ error, reset }) {
  useEffect(() => {
    // Log the error to an error reporting service
    console.error(error)
  }, [error])

  return (
    <div className="container mx-auto flex h-screen flex-col items-center justify-center gap-4 pt-10 text-white">
      <FrownIcon className="h-12 w-12" />
      <h2 className="text-5xl">¡Algo salió mal!</h2>
      <h3>{error.message}</h3>
      <Button onClick={() => reset()}>Intentar de nuevo</Button>
    </div>
  )
}
