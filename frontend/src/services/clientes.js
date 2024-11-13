import useSWR from 'swr'

export function useEquiposClientes({ fechaDesde, fechaHasta, onSuccess } = {}) {
  const queryParams = new URLSearchParams()

  if (fechaDesde) queryParams.append('fecha_desde', fechaDesde)
  if (fechaHasta) queryParams.append('fecha_hasta', fechaHasta)

  const qs = queryParams.toString()
  const endpoint = qs ? `/api/clientes/equipos?${qs}` : '/api/clientes/equipos'

  const { data, error, isLoading, mutate, ...rest } = useSWR(endpoint, {
    suspense: false,
    revalidateOnMount: false,
    onSuccess: data => {
      if (onSuccess) onSuccess(data)
    },
  })

  return {
    equipos: data,
    isLoading,
    isError: error,
    fetchEquipos: mutate,
    ...rest,
  }
}
