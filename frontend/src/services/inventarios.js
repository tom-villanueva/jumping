import useSWR from 'swr'

export function useInventarios({ params, filters } = {}) {
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

  const { data, error, isLoading, ...rest } = useSWR(['/api/inventarios', qs])

  return {
    inventarios: data,
    isLoading,
    isError: error,
    ...rest,
  }
}