import Header from '../Header'
import ReservasContainer from './sections/ReservasContainer'

export default function ReservasPage() {
  return (
    <>
      <Header title="Reservas" />
      <div className="container mx-auto pt-10">
        <ReservasContainer />
      </div>
    </>
  )
}
