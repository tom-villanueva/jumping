import { getEquipos } from '@/services/equipos'
import EquiposContainer from './sections/equipo/EquiposContainer'
import { getTipoArticulos } from '@/services/tipo-articulos'
import { Suspense } from 'react'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'
import TipoArticulosContainer from './sections/tipo-articulos/TipoArticulosContainer'
import { getTalles } from '@/services/talles'
import TallesContainer from './sections/talles/TallesContainer'

const Equipos = async () => {
  const equipos = await getEquipos({
    params: {
      include: 'equipo_tipo_articulo',
      sort: 'id',
    },
  })

  const tipoArticulos = await getTipoArticulos({
    params: {
      include: 'tipo_articulo_talle',
      sort: 'id',
    },
  })

  const talles = await getTalles({
    params: {
      include: 'tipo_articulo_talle',
      sort: 'id',
    },
  })

  return (
    <div className="container mx-auto pt-10">
      <Suspense fallback={<p>Loading...</p>}>
        <Tabs defaultValue="equipos" className="">
          <TabsList>
            <TabsTrigger value="equipos">Equipos</TabsTrigger>
            <TabsTrigger value="tipo_articulos">Tipos de Artículos</TabsTrigger>
            <TabsTrigger value="talles">Talles</TabsTrigger>
          </TabsList>
          <TabsContent value="equipos">
            <EquiposContainer equipos={equipos} tipoArticulos={tipoArticulos} />
          </TabsContent>
          <TabsContent value="tipo_articulos">
            <TipoArticulosContainer
              tipoArticulos={tipoArticulos}
              talles={talles}
            />
          </TabsContent>
          <TabsContent value="talles">
            <TallesContainer talles={talles} tipoArticulos={tipoArticulos} />
          </TabsContent>
        </Tabs>
      </Suspense>
    </div>
  )
}

export default Equipos
