import useSWR from 'swr'

// const baseUrl = process.env.NEXT_PUBLIC_BACKEND_URL

// export async function getEquipos({ params } = {}) {
//   const queryParams = new URLSearchParams(params)

//   const xsrf = cookies().get('XSRF-TOKEN')

//   const res = await fetch(`${baseUrl}/api/equipos?${queryParams}`, {
//     headers: {
//       'X-XSRF-TOKEN': xsrf.value,
//       Accept: 'application/json',
//     },
//     credentials: 'include',
//     next: { tags: 'equipos' },
//   })

//   if (!res.ok) {
//     const error = await res.json()
//     throw new Error('Error cargando los equipos')
//   }

//   const json = await res.json()

//   return json
// }

export function useEquipos({ params, filters } = {}) {
  const filterParams = {}

  filters.forEach(filter => {
    filterParams[`filter[${filter.id}]`] = filter.value
  })

  const allParams = {
    ...params,
    ...filterParams,
  }

  const queryParams = new URLSearchParams(allParams)

  const qs = queryParams.toString()

  const { data, error, isLoading, ...rest } = useSWR(['/api/equipos', qs])

  return {
    equipos: data,
    isLoading,
    isError: error,
    ...rest,
  }
}
