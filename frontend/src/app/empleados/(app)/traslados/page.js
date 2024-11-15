import Header from '../Header'
import TrasladosTable from './TrasladosTable'

export default function TrasladosPage() {
  return (
    <>
      <Header title="Traslados" />
      <div className="container mx-auto pt-10">
        <TrasladosTable />
      </div>
    </>
  )
}
