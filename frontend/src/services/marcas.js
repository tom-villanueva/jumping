import useSWR from 'swr'

export function useMarcas({ params } = {}) {
  const queryParams = new URLSearchParams(params)

  const qs = queryParams.toString()

  const { data, error, isLoading } = useSWR(['/api/marcas', qs])

  return {
    marcas: data,
    isLoading,
    isError: error,
  }
}
