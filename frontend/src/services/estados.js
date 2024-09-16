import useSWR from 'swr'

export function useEstados({ params } = {}) {
  const queryParams = new URLSearchParams(params)

  const qs = queryParams.toString()

  const { data, error, isLoading } = useSWR(['/api/estados', qs])

  return {
    estados: data,
    isLoading,
    isError: error,
  }
}
