'use client'

import { useEquipos } from '@/services/equipos'
import EquiposContainer from './sections/equipo/EquiposContainer'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'
import TipoArticulosContainer from './sections/tipo-articulos/TipoArticulosContainer'
import TallesContainer from './sections/talles/TallesContainer'
import DescuentosContainer from './sections/descuentos/DescuentosContainer'
import MarcasContainer from './sections/marcas/MarcasContainer'
import ModelosContainer from './sections/modelos/ModelosContainer'
import Header from '../Header'
import TrasladoPrecioContainer from './sections/traslado-precio/TrasladoPrecioContainer'

const Equipos = () => {
  return (
    <>
      <Header title="Equipos" />
      <div className="container mx-auto pt-10">
        {/* <Suspense fallback={<p>Loading...</p>}> */}
        <Tabs defaultValue="equipos" className="">
          <TabsList className="mb-10">
            <TabsTrigger value="equipos">Equipos</TabsTrigger>
            <TabsTrigger value="tipo_articulos">Tipos de Artículos</TabsTrigger>
            <TabsTrigger value="talles">Talles</TabsTrigger>
            <TabsTrigger value="marcas">Marcas</TabsTrigger>
            <TabsTrigger value="modelos">Modelos</TabsTrigger>
            <TabsTrigger value="traslado_precios">
              Precios de Traslados
            </TabsTrigger>
            <TabsTrigger value="descuentos">Descuentos</TabsTrigger>
          </TabsList>
          <TabsContent value="equipos">
            <EquiposContainer />
          </TabsContent>
          <TabsContent value="tipo_articulos">
            <TipoArticulosContainer />
          </TabsContent>
          <TabsContent value="talles">
            <TallesContainer />
          </TabsContent>
          <TabsContent value="marcas">
            <MarcasContainer />
          </TabsContent>
          <TabsContent value="modelos">
            <ModelosContainer />
          </TabsContent>
          <TabsContent value="traslado_precios">
            <TrasladoPrecioContainer />
          </TabsContent>
          <TabsContent value="descuentos">
            <DescuentosContainer />
          </TabsContent>
        </Tabs>
        {/* </Suspense> */}
      </div>
    </>
  )
}

export default Equipos
