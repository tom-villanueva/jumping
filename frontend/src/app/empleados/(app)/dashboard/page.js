import Header from '@/app/empleados/(app)/Header'
import InfoCard from '@/app/empleados/(app)/dashboard/sections/InfoCard'
import InfoChart from '@/app/empleados/(app)/dashboard/sections/InfoChart'
import { DataTable } from '@/app/empleados/(app)/dashboard/sections/dataTable/DataTable'
import PagosContainer from './sections/PagosContainer'
import EstadisticasContainer from './sections/EstadisticasContainer'

export const metadata = {
  title: 'Jumping - Dashboard',
}

const Dashboard = () => {
  return (
    <>
      <Header title="Dashboard" />
      <div className="py-12">
        <div className="mx-auto max-w-7xl sm:px-6 lg:px-8 ">
          <div className="grid grid-cols-1 gap-0  overflow-hidden px-2 sm:grid-cols-5 sm:gap-5">
            <EstadisticasContainer />
            <p className="p-5 text-xl font-bold text-white">Pagos</p>
            <div className="col-span-1 mt-5 sm:col-span-5 sm:mt-0">
              <PagosContainer />
            </div>
          </div>
        </div>
      </div>
    </>
  )
}

export default Dashboard
