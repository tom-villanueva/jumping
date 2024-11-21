import Header from '../Header'
import ClientesContainer from './ClientesContainer'

export default function ClientesPage() {
  return (
    <>
      <Header title="Clientes" />
      <div className="container mx-auto pt-10">
        <ClientesContainer />
      </div>
    </>
  )
}
