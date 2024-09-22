'use client'
import { useTipoArticulos } from '@/services/tipo-articulos'
import TotalStockChart from './TotalStockChart'

export default function StockGraphs() {
  const { tipoArticulos, isLoading: isLoadingTipoArticulos } = useTipoArticulos(
    {},
  )

  if (isLoadingTipoArticulos) {
    return <p>Cargando...</p>
  }

  return (
    <div className="grid w-full grid-cols-12">
      <div className="col-span-4 flex h-96 flex-col gap-8 rounded-lg border border-slate-400 bg-slate-700 p-3">
        <p className="ml-5 text-xl font-bold text-white">Stock Total</p>
        <TotalStockChart tipoArticulos={tipoArticulos} />
      </div>
    </div>
  )
}
