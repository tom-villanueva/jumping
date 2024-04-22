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
    console.error(res)
    throw new Error('Error cargando los tipo artículos')
  }

  const json = await res.json()

  return json
}
