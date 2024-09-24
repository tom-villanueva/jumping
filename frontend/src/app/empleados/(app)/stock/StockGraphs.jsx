'use client'
import useAccumulatedTotals from '@/hooks/useAccumulatedTotals'
import TotalStockChart from './TotalStockChart'

export default function StockGraphs({ inventario = [] }) {
  // Calculate total stock by tipo_articulo, marca, modelo, and talle
  const { tipoTotalizers, marcaTotalizers, modeloTotalizers, talleTotalizers } =
    useAccumulatedTotals(inventario)

  return (
    <div className="grid w-full grid-cols-12 gap-2 pt-4">
      <div className="col-span-6 flex h-96 flex-col rounded-lg border border-slate-400 bg-slate-700 p-3">
        <p className="ml-5 text-xl font-bold text-white">Stock Por Tipo</p>
        <TotalStockChart data={tipoTotalizers} />
      </div>
      <div className="col-span-6 flex h-96 flex-col rounded-lg border border-slate-400 bg-slate-700 p-3">
        <p className="ml-5 text-xl font-bold text-white">Stock Por Talle</p>
        <TotalStockChart data={talleTotalizers} />
      </div>
      <div className="col-span-6 flex h-96 flex-col rounded-lg border border-slate-400 bg-slate-700 p-3">
        <p className="ml-5 text-xl font-bold text-white">Stock Por Marca</p>
        <TotalStockChart data={marcaTotalizers} />
      </div>
      <div className="col-span-6 flex h-96 flex-col rounded-lg border border-slate-400 bg-slate-700 p-3">
        <p className="ml-5 text-xl font-bold text-white">Stock Por Modelo</p>
        <TotalStockChart data={modeloTotalizers} />
      </div>
    </div>
  )
}
