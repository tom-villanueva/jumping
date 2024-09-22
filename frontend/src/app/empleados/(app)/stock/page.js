import StockGraphs from './StockGraphs'
import StockTable from './StockTable'

export default function StockPage() {
  const columns = [
    {
      accessorKey: 'tipo_articulo.descripcion',
      id: 'tipo_articulo.id',
      header: 'Tipo',
    },
    {
      accessorKey: 'talle.descripcion',
      id: 'talle.id',
      header: 'Talle',
    },
    {
      accessorKey: 'stock',
      id: 'stock',
      header: 'Stock Total',
    },
  ]

  return (
    <div className="container mx-auto pt-10">
      <StockGraphs />
      <StockTable columns={columns} />
    </div>
  )
}
