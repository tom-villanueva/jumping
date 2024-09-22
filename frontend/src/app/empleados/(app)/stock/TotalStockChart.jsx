import { chartColors } from '@/lib/utils'
import { useMemo } from 'react'
import { PieChart, Pie, ResponsiveContainer, LabelList, Cell } from 'recharts'

export default function TotalStockChart({ tipoArticulos }) {
  // const data = useMemo(() => {
  //   return tipoArticulos.map(tipo => {
  //     return {
  //       name: tipo.descripcion,
  //       value: tipo.tipo_articulo_talle.reduce(
  //         (acc, current) => acc + current.pivot.stock,
  //         0,
  //       ),
  //     }
  //   })
  // }, [tipoArticulos])

  return (
    <ResponsiveContainer width="100%" height="100%">
      {data && data.length > 0 && (
        <PieChart width={600} height={300}>
          <Pie
            data={data}
            isAnimationActive
            label
            dataKey="value"
            nameKey="name"
            outerRadius={50}
            fill="#8884d8">
            <LabelList
              dataKey="name"
              position="right"
              style={{ fontSize: '10px' }}
            />
            {data.map((entry, index) => (
              <Cell key={`cell-${index}`} fill={chartColors[index]} />
            ))}
          </Pie>
        </PieChart>
      )}
    </ResponsiveContainer>
  )
}
