'use client'
import {
  LineChart,
  Line,
  CartesianGrid,
  XAxis,
  YAxis,
  Tooltip,
  ResponsiveContainer,
} from 'recharts'
const data = [
  { name: 'Junio', 2024: 400, 2023: 300, amt: 2400 },
  { name: 'Julio', 2024: 700, 2023: 600, amt: 2400 },
  { name: 'Agosto', 2024: 520, 2023: 540, amt: 2400 },
  { name: 'Septiembre', 2024: 400, 2023: 500, amt: 2400 },
  { name: 'Octubre', 2024: 250, 2023: 200, amt: 2400 },
]

const InfoChart = () => {
  return (
    <ResponsiveContainer width="100%" height="100%">
      <LineChart
        width={600}
        s
        height={300}
        data={data}
        margin={{ top: 5, right: 20, bottom: 5, left: 0 }}>
        <Line
          type="monotone"
          dataKey="2024"
          stroke="#4684d8"
          activeDot={{ r: 8 }}
        />
        <Line type="monotone" dataKey="2023" stroke="#8884d8" />
        <CartesianGrid stroke="#ccc" strokeDasharray="5 5" />
        <XAxis dataKey="name" />
        <YAxis />
        <Tooltip />
      </LineChart>
    </ResponsiveContainer>
  )
}

export default InfoChart
