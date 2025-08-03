// API Helper untuk Next.js Frontend
// Simpan file ini di src/lib/api.js

const API_BASE_URL = 'http://127.0.0.1:8000/api';

class ApiService {
  async get(endpoint) {
    try {
      const response = await fetch(`${API_BASE_URL}${endpoint}`, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();
      return data;
    } catch (error) {
      console.error('API GET Error:', error);
      throw error;
    }
  }

  async post(endpoint, data) {
    try {
      const response = await fetch(`${API_BASE_URL}${endpoint}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: JSON.stringify(data),
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const result = await response.json();
      return result;
    } catch (error) {
      console.error('API POST Error:', error);
      throw error;
    }
  }

  // Khusus untuk testing API
  async testConnection() {
    return this.get('/test');
  }

  // API untuk mahasiswa
  async getMahasiswa() {
    return this.get('/mahasiswa');
  }

  async getMahasiswaById(id) {
    return this.get(`/mahasiswa/${id}`);
  }
}

// Export instance
const apiService = new ApiService();
export default apiService;

// Export individual functions
export const testApi = () => apiService.testConnection();
export const getMahasiswa = () => apiService.getMahasiswa();
export const getMahasiswaById = (id) => apiService.getMahasiswaById(id);
