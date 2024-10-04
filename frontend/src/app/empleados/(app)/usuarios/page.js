'use client'

import Header from '../Header'
import EmpleadosContainer from './sections/EmpleadosContainer'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'
import UsersContainer from './sections/UsersContainer'

export default function ReservasPage() {
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
            <EmpleadosContainer />
          </TabsContent>
          <TabsContent value="clientes">
            <UsersContainer />
          </TabsContent>
        </Tabs>
      </div>
    </>
  )
}
