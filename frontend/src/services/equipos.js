import axios from '@/lib/axios'
import { CustomValidationError } from '@/lib/utils'
import { cookies } from 'next/headers'

const baseUrl = process.env.NEXT_PUBLIC_BACKEND_URL

export async function getEquipos({ params } = {}) {
  const queryParams = new URLSearchParams(params)

  const xsrf = cookies().get('XSRF-TOKEN')

  const res = await fetch(`${baseUrl}/api/equipos?${queryParams}`, {
    headers: {
      'X-XSRF-TOKEN': xsrf.value,
      Accept: 'application/json',
    },
    credentials: 'include',
    next: { tags: 'equipos' },
  })

  if (!res.ok) {
    const error = await res.json()
    throw new Error('Error cargando los equipos')
  }

  const json = await res.json()

  return json
}

export async function storeEquipo(data) {
  return axios.post(`/api/equipos`, data)
}

export async function updateEquipo(id, data) {
  return axios.put(`/api/equipos/${id}`, data)
}

export async function deleteEquipo(id) {
  return axios.delete(`/api/equipos/${id}`)
}

export async function storeEquipoDescuento(data) {
  return axios.post(`/api/equipos/descuentos`, data)
}

export async function updateEquipoDescuento(id, data) {
  return axios.put(`/api/equipos/descuentos/${id}`, data)
}

export async function deleteEquipoDescuento(id) {
  return axios.delete(`/api/equipos/descuentos/${id}`)
}

export async function uploadEquipoThumbnail(id, data) {
  const xsrf = cookies().get('XSRF-TOKEN')

  const res = await fetch(`${baseUrl}/api/equipos/${id}/upload-thumbnail`, {
    method: 'POST',
    body: data,
    headers: {
      'X-XSRF-TOKEN': xsrf.value,
      Accept: 'application/json',
    },
    credentials: 'include',
  })

  if (!res.ok) {
    const json = await res.json()
    throw new CustomValidationError(json?.message, json?.errors ?? [])
  }

  const json = await res.json()

  return json
}
