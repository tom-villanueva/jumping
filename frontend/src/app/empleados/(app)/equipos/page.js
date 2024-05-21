import { getEquipos } from '@/services/equipos'
import EquiposContainer from './sections/equipo/EquiposContainer'
import { getTipoArticulos } from '@/services/tipo-articulos'
import { Suspense } from 'react'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'
import TipoArticulosContainer from './sections/tipo-articulos/TipoArticulosContainer'
import { getTalles } from '@/services/talles'
import { getDescuentos } from '@/services/descuentos'
import TallesContainer from './sections/talles/TallesContainer'
import DescuentosContainer from './sections/descuentos/DescuentosContainer'

const Equipos = async () => {
  const equipos = await getEquipos({
    params: {
      include: 'equipo_tipo_articulo,descuentos_vigentes',
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

  const descuentos = await getDescuentos({})

  return (
    <div className="container mx-auto pt-10">
      <Suspense fallback={<p>Loading...</p>}>
        <Tabs defaultValue="equipos" className="">
          <TabsList>
            <TabsTrigger value="equipos">Equipos</TabsTrigger>
            <TabsTrigger value="tipo_articulos">Tipos de Artículos</TabsTrigger>
            <TabsTrigger value="talles">Talles</TabsTrigger>
            <TabsTrigger value="descuentos">Descuentos</TabsTrigger>
          </TabsList>
          <TabsContent value="equipos">
            <EquiposContainer
              equipos={equipos}
              tipoArticulos={tipoArticulos}
              descuentos={descuentos}
            />
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
          <TabsContent value="descuentos">
            <DescuentosContainer descuentos={descuentos} />
          </TabsContent>
        </Tabs>
      </Suspense>
    </div>
  )
}

export default Equipos
