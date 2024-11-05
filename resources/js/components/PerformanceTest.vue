<template>
    <div class="performance-test-container">
        <h1>Website Performance Test</h1>
        <form @submit.prevent="submitTest">
            <input
                type="url"
                v-model="url"
                placeholder="Enter website URL"
                required
            />
            <select v-model="platform" required>
                <option value="" disabled>Select Platform</option>
                <option value="mobile">Mobile</option>
                <option value="desktop">Desktop</option>
            </select>
            <button type="submit">Test Performance</button>
        </form>
        <div v-if="performanceScore !== null">
            <h2>Performance Score: {{ performanceScore }}</h2>
        </div>
        <button @click="logout">Logout</button>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            url: '',
            platform: '',
            performanceScore: null,
        };
    },
    methods: {
        async submitTest() {
    try {
        const response = await axios.post('http://127.0.0.1:8000/api/performance-test', {
            url: this.url,
            platform: this.platform,
        });
        this.performanceScore = response.data.score;
    } catch (error) {
        console.error('Error fetching performance score:', error);
        alert('Error fetching performance score. Details: ' + (error.response?.data?.error || error.message));
    }
},
        logout() {
            localStorage.removeItem('token'); // Clear token
            window.location.href = '/'; // Redirect to login page
        },
    },
};
</script>

<style scoped>
.performance-test-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    text-align: center;
}
input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
}
select {
    padding: 10px;
    margin: 10px 0;
}
button {
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
}
</style>
