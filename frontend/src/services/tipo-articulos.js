import axios from '@/lib/axios'
import { cookies } from 'next/headers'

const baseUrl = process.env.NEXT_PUBLIC_BACKEND_URL

export async function getTipoArticulos({ params } = {}) {
  const queryParams = new URLSearchParams(params)

  const xsrf = cookies().get('XSRF-TOKEN')

  const res = await fetch(`${baseUrl}/api/tipo-articulos?${queryParams}`, {
    headers: {
      'X-XSRF-TOKEN': xsrf.value,
    },
    credentials: 'include',
    next: { tags: 'tipo-articulos' },
  })

  if (!res.ok) {
    throw new Error('Error cargando los tipo artículos')
  }

  const json = await res.json()

  return json
}

export async function storeTipoArticulo(data) {
  return axios.post(`${baseUrl}/api/tipo-articulos`, data)
}

export async function updateTipoArticulo(id, data) {
  return axios.put(`${baseUrl}/api/tipo-articulos/${id}`, data)
}

export async function deleteTipoArticulo(id) {
  return axios.delete(`${baseUrl}/api/tipo-articulos/${id}`)
}
