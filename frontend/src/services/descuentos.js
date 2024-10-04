import useSWR from 'swr'

export function useDescuentos({ params, filters } = {}) {
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

  const { data, error, isLoading, ...rest } = useSWR(['/api/descuentos', qs])

  return {
    descuentos: data,
    isLoading,
    isError: error,
    ...rest,
  }
}
