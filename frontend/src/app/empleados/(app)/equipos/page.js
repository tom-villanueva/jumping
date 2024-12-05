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
import MetodoPagosContainer from './sections/metodo-pagos/MetodoPagosContainer'
import TipoPersonasContainer from './sections/tipo-personas/TipoPersonasContainer'
import TrasladoAsientoContainer from './sections/traslado-precio/TrasladoAsientoContainer'
import TipoEquiposContainer from './sections/tipo-equipos/TipoEquipoContainer'

const Equipos = () => {
  return (
    <>
      <Header title="Equipos" />
      <div className="container mx-auto pt-10">
        {/* <Suspense fallback={<p>Loading...</p>}> */}
        <Tabs defaultValue="equipos" className="">
          <TabsList className="mb-10 flex h-auto flex-wrap items-center justify-start space-y-1">
            <TabsTrigger value="equipos">Equipos</TabsTrigger>
            <TabsTrigger value="tipo_articulos">Tipos de Artículos</TabsTrigger>
            <TabsTrigger value="talles">Talles</TabsTrigger>
            <TabsTrigger value="marcas">Marcas</TabsTrigger>
            <TabsTrigger value="modelos">Modelos</TabsTrigger>
            <TabsTrigger value="traslado_precios">
              Precios de Traslados
            </TabsTrigger>
            <TabsTrigger value="descuentos">Descuentos</TabsTrigger>
            <TabsTrigger value="metodos">Método de pagos</TabsTrigger>
            <TabsTrigger value="tipo_personas">Tipos de clientes</TabsTrigger>
            <TabsTrigger value="tipo_equipos">Tipos de equipos</TabsTrigger>
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
            <TrasladoAsientoContainer />
          </TabsContent>
          <TabsContent value="descuentos">
            <DescuentosContainer />
          </TabsContent>
          <TabsContent value="metodos">
            <MetodoPagosContainer />
          </TabsContent>
          <TabsContent value="tipo_personas">
            <TipoPersonasContainer />
          </TabsContent>
          <TabsContent value="tipo_equipos">
            <TipoEquiposContainer />
          </TabsContent>
        </Tabs>
        {/* </Suspense> */}
      </div>
    </>
  )
}

export default Equipos
