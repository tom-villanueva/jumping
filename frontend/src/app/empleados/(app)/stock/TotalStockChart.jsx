import { chartColors } from '@/lib/utils'
import { useMemo } from 'react'
import { PieChart, Pie, ResponsiveContainer, LabelList, Cell } from 'recharts'

export default function TotalStockChart({ data }) {
  return (
    <ResponsiveContainer width="100%" height="100%">
      {data && data.length > 0 && (
        <PieChart width={600} height={400}>
          <Pie
            data={data}
            isAnimationActive
            label
            dataKey="value"
            nameKey="name"
            outerRadius={50}>
            <LabelList
              dataKey="name"
              position="right"
              style={{ fontSize: '10px' }}
            />
            {data.map((entry, index) => (
              <Cell
                key={`cell-${index}`}
                fill={chartColors[index % chartColors.length]}
              />
            ))}
          </Pie>
        </PieChart>
      )}
    </ResponsiveContainer>
  )
}
