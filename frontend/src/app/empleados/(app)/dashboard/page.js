import Header from '@/app/empleados/(app)/Header'
import InfoCard from '@/app/empleados/(app)/dashboard/sections/InfoCard'
import InfoChart from '@/app/empleados/(app)/dashboard/sections/InfoChart'
import { DataTable } from '@/app/empleados/(app)/dashboard/sections/dataTable/DataTable'

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
            <div className="col-span-2 mb-5 grid w-full grid-cols-2 gap-2 sm:my-0 sm:gap-5">
              <InfoCard
                title="Valor neto"
                number="1333"
                percentage="7"
                footer="Año actual"
              />

              <InfoCard
                title="Reservas activas"
                number="13"
                percentage="5"
                footer="Al momento"
              />
              <InfoCard
                title="Ganancia"
                number="$50000"
                percentage="3"
                footer="En el mes"
              />
              <InfoCard
                title="Valor neto"
                number="$200000"
                percentage="8"
                footer="Año anterior"
              />
            </div>
            <div className="col-span-3 flex flex-col gap-8 rounded-lg border border-slate-400 bg-slate-700 p-3">
              <p className="ml-5 text-xl font-bold text-white">Reservas</p>
              <InfoChart />
            </div>
            <p className="p-5 text-xl font-bold text-white">Pagos entrantes</p>
            <div className="col-span-1 mt-5 max-h-80 overflow-auto rounded-lg border-b border-t sm:col-span-5 sm:mt-0">
              <DataTable />
            </div>
          </div>
        </div>
      </div>
    </>
  )
}

export default Dashboard
