import axios from '@/lib/axios'
import { cookies } from 'next/headers'

const baseUrl = process.env.NEXT_PUBLIC_BACKEND_URL

export async function getEquipos({ params } = {}) {
  const queryParams = new URLSearchParams(params)

  const xsrf = cookies().get('XSRF-TOKEN')

  const res = await fetch(`${baseUrl}/api/equipos?${queryParams}`, {
    headers: {
      'X-XSRF-TOKEN': xsrf.value,
    },
    credentials: 'include',
    next: { tags: 'equipos' },
  })

  if (!res.ok) {
    console.error(res)
    throw new Error('Error cargando los equipos')
  }

  const json = await res.json()

  return json
}

export async function storeEquipo(data) {
  return axios.post(`${baseUrl}/api/equipos`, data)
}
