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

export async function updateEquipo(id, data) {
  return axios.put(`${baseUrl}/api/equipos/${id}`, data)
}

export async function deleteEquipo(id) {
  return axios.delete(`${baseUrl}/api/equipos/${id}`)
}

export async function uploadEquipoThumbnail(id, data) {
  // return axios.post(`${baseUrl}/api/equipos/${id}/upload-thumbnail`, data)
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
    throw new CustomValidationError(json.message, json.errors)
  }

  const json = await res.json()

  return json
}
