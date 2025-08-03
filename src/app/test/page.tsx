import { useState, useEffect } from 'react';

export default function TestPage() {
  const [mahasiswa, setMahasiswa] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    fetchMahasiswa();
  }, []);

  const fetchMahasiswa = async () => {
    try {
      const response = await fetch('http://localhost:8000/api/mahasiswa');
      if (!response.ok) {
        throw new Error('Failed to fetch');
      }
      const data = await response.json();
      setMahasiswa(data.data || []);
    } catch (err) {
      setError(err.message);
    } finally {
      setLoading(false);
    }
  };

  if (loading) return <div className="p-8">Loading...</div>;
  if (error) return <div className="p-8 text-red-500">Error: {error}</div>;

  return (
    <div className="container mx-auto p-8">
      <h1 className="text-2xl font-bold mb-6">Test Database - Data Mahasiswa</h1>
      
      <div className="bg-white rounded-lg shadow overflow-hidden">
        <table className="min-w-full">
          <thead className="bg-gray-50">
            <tr>
              <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIM</th>
              <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
              <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jurusan</th>
              <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Program Studi</th>
              <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">IPK</th>
              <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">SKS Total</th>
              <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
            </tr>
          </thead>
          <tbody className="divide-y divide-gray-200">
            {mahasiswa.map((mhs) => (
              <tr key={mhs.id} className="hover:bg-gray-50">
                <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                  {mhs.nim}
                </td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  {mhs.nama}
                </td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  {mhs.jurusan}
                </td>
                <td className="px-6 py-4 text-sm text-gray-900">
                  {mhs.program_studi || '-'}
                </td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  {mhs.ipk || '-'}
                </td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  {mhs.sks_total || '-'}
                </td>
                <td className="px-6 py-4 whitespace-nowrap">
                  <span className={`inline-flex px-2 py-1 text-xs font-semibold rounded-full ${
                    mhs.status === 'aktif' 
                      ? 'bg-green-100 text-green-800' 
                      : 'bg-red-100 text-red-800'
                  }`}>
                    {mhs.status}
                  </span>
                </td>
              </tr>
            ))}
          </tbody>
        </table>

        {mahasiswa.length === 0 && (
          <div className="p-8 text-center text-gray-500">
            Tidak ada data mahasiswa ditemukan
          </div>
        )}
      </div>

      <div className="mt-8 p-4 bg-gray-100 rounded-lg">
        <h2 className="text-lg font-semibold mb-2">Informasi Database:</h2>
        <p>Total mahasiswa: {mahasiswa.length}</p>
        <p>Mahasiswa dengan IPK: {mahasiswa.filter(m => m.ipk).length}</p>
        <p>Mahasiswa dengan SKS Total: {mahasiswa.filter(m => m.sks_total).length}</p>
        <p>Mahasiswa dengan Program Studi: {mahasiswa.filter(m => m.program_studi).length}</p>
      </div>
    </div>
  );
}
