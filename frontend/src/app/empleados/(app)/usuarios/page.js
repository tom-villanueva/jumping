'use client'

import { useEmpleados } from '@/services/empleados'
import Header from '../Header'
import EmpleadosContainer from './sections/EmpleadosContainer'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'

export default function ReservasPage() {
  const {
    empleados,
    isLoading: isLoadingEmpleados,
    isError: isErrorEmpleados,
  } = useEmpleados({
    params: {
      sort: 'id',
    },
    filters: [],
  })

  if (isErrorEmpleados) {
    return <p>Error cargando los empleados</p>
  }

  if (isLoadingEmpleados) {
    return <p>Cargando...</p>
  }

  return (
    <>
      <Header title="Usuarios" />
      <div className="container mx-auto pt-10">
        <Tabs defaultValue="empleados" className="">
          <TabsList>
            <TabsTrigger value="empleados">Empleados</TabsTrigger>
            <TabsTrigger value="clientes">Usuarios clientes</TabsTrigger>
          </TabsList>
          <TabsContent value="empleados">
            <EmpleadosContainer empleados={empleados} />
          </TabsContent>
          <TabsContent value="clientes">Clientes</TabsContent>
        </Tabs>
      </div>
    </>
  )
}
