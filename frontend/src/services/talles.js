import useSWR from 'swr'

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
