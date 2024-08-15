import axios from '@/lib/axios'
// import { cookies } from 'next/headers'
import useSWR from 'swr'

// const baseUrl = process.env.NEXT_PUBLIC_BACKEND_URL

// export async function getTalles({ params } = {}) {
//   const queryParams = new URLSearchParams(params)

//   const xsrf = cookies().get('XSRF-TOKEN')

//   const res = await fetch(`${baseUrl}/api/talles?${queryParams}`, {
//     headers: {
//       'X-XSRF-TOKEN': xsrf.value,
//       Accept: 'application/json',
//     },
//     credentials: 'include',
//     next: { tags: 'talles' },
//   })

//   if (!res.ok) {
//     throw new Error('Error cargando los talles')
//   }

//   const json = await res.json()

//   return json
// }

export function useTalles({ params } = {}) {
  const queryParams = new URLSearchParams(params)

  const qs = queryParams.toString()

  const { data, error, isLoading } = useSWR(['/api/talles', qs])

  return {
    talles: data,
    isLoading,
    isError: error,
  }
}

export async function storeTalle(data) {
  return axios.post(`/api/talles`, data)
}

export async function updateTalle(id, data) {
  return axios.put(`/api/talles/${id}`, data)
}

export async function deleteTalle(id) {
  return axios.delete(`/api/talles/${id}`)
}
