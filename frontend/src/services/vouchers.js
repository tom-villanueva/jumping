import useSWR from 'swr'

export function useVouchers({ params, filters } = {}) {
  const filterParams = {}

  filters &&
    filters.forEach(filter => {
      filterParams[`filter[${filter.id}]`] = filter.value
    })

  const allParams = {
    ...params,
    ...filterParams,
  }

  const queryParams = new URLSearchParams(allParams)

  const qs = queryParams.toString()

  const { data, error, isLoading, ...rest } = useSWR(['/api/vouchers', qs])

  return {
    vouchers: data,
    isLoading,
    isError: error,
    ...rest,
  }
}

export function useEquipoVoucher({ params, filters } = {}) {
  const filterParams = {}

  filters &&
    filters.forEach(filter => {
      filterParams[`filter[${filter.id}]`] = filter.value
    })

  const allParams = {
    ...params,
    ...filterParams,
  }

  const queryParams = new URLSearchParams(allParams)

  const qs = queryParams.toString()

  const { data, error, isLoading, ...rest } = useSWR([
    '/api/reserva-equipos',
    qs,
  ])

  return {
    reservaEquipos: data,
    isLoading,
    isError: error,
    ...rest,
  }
}
