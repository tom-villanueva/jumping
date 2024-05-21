import axios from '@/lib/axios'
import { cookies } from 'next/headers'

const baseUrl = process.env.NEXT_PUBLIC_BACKEND_URL

export async function getDescuentos({ params } = {}) {
  const queryParams = new URLSearchParams(params)

  const xsrf = cookies().get('XSRF-TOKEN')

  const res = await fetch(`${baseUrl}/api/descuentos?${queryParams}`, {
    headers: {
      'X-XSRF-TOKEN': xsrf.value,
      Accept: 'application/json',
    },
    credentials: 'include',
    next: { tags: 'descuentos' },
  })

  if (!res.ok) {
    throw new Error('Error cargando los descuentos')
  }

  const json = await res.json()

  return json
}

export async function storeDescuento(data) {
  return axios.post(`/api/descuentos`, data)
}

export async function updateDescuento(id, data) {
  return axios.put(`/api/descuentos/${id}`, data)
}

export async function deleteDescuento(id) {
  return axios.delete(`/api/descuentos/${id}`)
}
