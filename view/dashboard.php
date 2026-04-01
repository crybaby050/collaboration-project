
            <div class="bg-gradient-to-r from-[#2B88D9] to-[#99D0F2] rounded-2xl p-6 mb-8 shadow-lg animate-fade-up">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-rocket text-white text-2xl"></i>
                            <span class="bg-[#F2B705] text-[#2B88D9] text-xs font-bold px-3 py-1 rounded-full">NOUVEAU</span>
                        </div>
                        <h3 class="text-white text-xl font-bold mb-2">Boostez votre productivité avec Mbollo</h3>
                        <p class="text-white/90 text-sm mb-3">Organisez vos projets, collaborez en équipe et atteignez vos objectifs plus rapidement que jamais.</p>
                        <button class="bg-[#F2B705] hover:bg-[#F29F05] text-[#2B88D9] font-semibold px-5 py-2 rounded-lg transition-all transform hover:scale-105 shadow-md">
                            <i class="fas fa-play mr-2"></i>Démarrer maintenant
                        </button>
                    </div>
                    <div class="hidden md:block">
                        <i class="fas fa-users text-white text-7xl opacity-30"></i>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl p-6 shadow-md stat-card card-animate" style="border-left: 4px solid #2B88D9;">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Tâches en cours</p>
                            <p class="text-3xl font-bold text-gray-800 counter" id="tasksCount">32</p>
                            <p class="text-xs text-green-500 mt-2">
                                <i class="fas fa-arrow-up"></i> +12% cette semaine
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-[#BDE3F2] flex items-center justify-center">
                            <i class="fas fa-spinner text-[#2B88D9] text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl p-6 shadow-md stat-card card-animate" style="border-left: 4px solid #F2B705;">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Projets actifs</p>
                            <p class="text-3xl font-bold text-gray-800 counter" id="projectsCount"><?= $nbProjet ?></p>
                            <p class="text-xs text-green-500 mt-2">
                                <i class="fas fa-arrow-up"></i> +3 nouveaux
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-[#F2B705]/20 flex items-center justify-center">
                            <i class="fas fa-folder-open text-[#F2B705] text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl p-6 shadow-md stat-card card-animate" style="border-left: 4px solid #99D0F2;">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Projets achevés</p>
                            <p class="text-3xl font-bold text-gray-800 counter" id="completedCount">1</p>
                            <p class="text-xs text-green-500 mt-2">
                                <i class="fas fa-check-circle"></i> Ce trimestre
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-[#99D0F2]/30 flex items-center justify-center">
                            <i class="fas fa-check-double text-[#2B88D9] text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl p-6 shadow-md stat-card card-animate" style="border-left: 4px solid #F29F05;">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Membres actifs</p>
                            <p class="text-3xl font-bold text-gray-800 counter" id="membersCount">6</p>
                            <p class="text-xs text-blue-500 mt-2">
                                <i class="fas fa-user-plus"></i> 2 en ligne
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-[#F29F05]/20 flex items-center justify-center">
                            <i class="fas fa-users text-[#F29F05] text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-md overflow-hidden animate-fade-up">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-chart-line text-[#2B88D9]"></i>
                        Statistiques de performance
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">Suivi des projets et tâches par équipe</p>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Projet</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Responsable</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avancement</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Échéance</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tâches</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-[#2B88D9]"></div>
                                        <span class="font-medium text-gray-900">Dashboard Analytics</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">Alexandre Martin</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-[#BDE3F2] text-[#2B88D9]">En cours</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-700">78%</span>
                                        <div class="flex-1 max-w-32 bg-gray-200 rounded-full h-2">
                                            <div class="progress-bar h-2 rounded-full" style="width: 78%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">05 Mars 2026</td>
                                <td class="px-6 py-4 text-sm text-gray-600">24/31</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-[#F2B705]"></div>
                                        <span class="font-medium text-gray-900">Refonte UI/UX</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">Sophie Laurent</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-600">Terminé</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-700">100%</span>
                                        <div class="flex-1 max-w-32 bg-gray-200 rounded-full h-2">
                                            <div class="progress-bar h-2 rounded-full" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">20 Fév 2026</td>
                                <td class="px-6 py-4 text-sm text-gray-600">18/18</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-[#99D0F2]"></div>
                                        <span class="font-medium text-gray-900">Système de notifications</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">Marc Dubois</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-[#BDE3F2] text-[#2B88D9]">En cours</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-700">45%</span>
                                        <div class="flex-1 max-w-32 bg-gray-200 rounded-full h-2">
                                            <div class="progress-bar h-2 rounded-full" style="width: 45%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">12 Mars 2026</td>
                                <td class="px-6 py-4 text-sm text-gray-600">12/27</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-[#F29F05]"></div>
                                        <span class="font-medium text-gray-900">Migration Base de données</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">Emma Weber</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-600">En attente</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-700">20%</span>
                                        <div class="flex-1 max-w-32 bg-gray-200 rounded-full h-2">
                                            <div class="progress-bar h-2 rounded-full" style="width: 20%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">18 Mars 2026</td>
                                <td class="px-6 py-4 text-sm text-gray-600">5/25</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-[#2B88D9]"></div>
                                        <span class="font-medium text-gray-900">API Documentation</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">Thomas Richard</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-[#BDE3F2] text-[#2B88D9]">En cours</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-700">62%</span>
                                        <div class="flex-1 max-w-32 bg-gray-200 rounded-full h-2">
                                            <div class="progress-bar h-2 rounded-full" style="width: 62%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">08 Mars 2026</td>
                                <td class="px-6 py-4 text-sm text-gray-600">16/26</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center flex-wrap gap-3">
                    <div class="text-sm text-gray-600">
                        <i class="fas fa-chart-simple text-[#2B88D9] mr-2"></i>
                        Productivité globale: <span class="font-bold text-gray-800">76.5%</span>
                    </div>
                    <button class="text-[#2B88D9] hover:text-[#1e6bb3] text-sm font-medium transition">
                        Voir rapport détaillé <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </div>
            </div>
            