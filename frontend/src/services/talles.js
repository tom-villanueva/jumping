import axios from '@/lib/axios'
import { cookies } from 'next/headers'

const baseUrl = process.env.NEXT_PUBLIC_BACKEND_URL

export async function getTalles({ params } = {}) {
  const queryParams = new URLSearchParams(params)

  const xsrf = cookies().get('XSRF-TOKEN')

  const res = await fetch(`${baseUrl}/api/talles?${queryParams}`, {
    headers: {
      'X-XSRF-TOKEN': xsrf.value,
    },
    credentials: 'include',
    next: { tags: 'talles' },
  })

  if (!res.ok) {
    console.error(res)
    throw new Error('Error cargando los talles')
  }

  const json = await res.json()

  return json
}