import useSWR from 'swr'

export function useReservas({ params, filters } = {}) {
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

  const { data, error, isLoading, ...rest } = useSWR(['/api/reservas', qs])

  return {
    reservas: data,
    isLoading,
    isError: error,
    ...rest,
  }
}

export function useReservaById({ id, params } = {}) {
  // const filterParams = {}

  // filters.forEach(filter => {
  //   filterParams[`filter[${filter.id}]`] = filter.value
  // })

  const allParams = {
    ...params,
    // ...filterParams,
  }

  const queryParams = new URLSearchParams(allParams)

  const qs = queryParams.toString()

  const { data, error, isLoading, ...rest } = useSWR([
    `/api/reservas/${id}`,
    qs,
  ])

  return {
    reserva: data,
    isLoading,
    isError: error,
    ...rest,
  }
}