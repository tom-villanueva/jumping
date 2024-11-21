import Header from '../Header'
import ClientesTable from './ClientesTable'

export default function TrasladosPage() {
  return (
    <>
      <Header title="Clientes" />
      <div className="container mx-auto pt-10">
        <ClientesTable />
      </div>
    </>
  )
}
