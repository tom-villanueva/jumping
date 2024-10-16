'use client'
import { chartColors } from '@/lib/utils'
import {
  LineChart,
  Line,
  CartesianGrid,
  XAxis,
  YAxis,
  Tooltip,
  ResponsiveContainer,
  Legend,
} from 'recharts'

const InfoChart = ({ data }) => {
  const years = Object.keys(data[0]).filter(key => key !== 'name')

  return (
    <ResponsiveContainer width="100%" height="100%">
      {data && data.length > 0 && (
        <LineChart
          width={600}
          s
          height={300}
          data={data}
          margin={{ top: 5, right: 20, bottom: 5, left: 0 }}>
          {years.map((year, index) => (
            <Line
              key={year}
              type="monotone"
              dataKey={year}
              stroke={chartColors[index]}
              activeDot={{ r: 8 }}
            />
          ))}
          <CartesianGrid stroke="#ccc" strokeDasharray="5 5" />
          <Legend />
          <XAxis dataKey="name" />
          <YAxis />
          <Tooltip
            formatter={(value, name, props) =>
              new Intl.NumberFormat('es-AR', {
                style: 'currency',
                currency: 'ARS',
              }).format(value)
            }
          />
        </LineChart>
      )}
    </ResponsiveContainer>
  )
}

export default InfoChart
