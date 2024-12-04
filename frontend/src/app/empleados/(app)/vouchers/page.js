import Header from '../Header'
import VouchersContainer from './VouchersContainer'

export default function VouchersPage() {
  return (
    <>
      <Header title="Vouchers" />
      <div className="container mx-auto pt-10">
        <VouchersContainer />
      </div>
    </>
  )
}
