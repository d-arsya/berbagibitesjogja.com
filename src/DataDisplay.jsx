import React, { useState, useEffect } from "react";
import {
  Calendar,
  MapPin,
  Briefcase,
  Users,
  Lock,
  Globe,
  RefreshCw,
  ExternalLink,
} from "lucide-react";

export default function DataDisplay() {
  const [entries, setEntries] = useState([]);
  const [loading, setLoading] = useState(false);
  const [message, setMessage] = useState({ type: "", text: "" });
  const [userDivision, setUserDivision] = useState(""); // User's division for filtering

  // API Base URL - change this to your Laravel API
  const BASE_URL = "https://app.berbagibitesjogja.com";
  const API_BASE_URL = `${BASE_URL}/api`;

  // Show message helper
  const showMessage = (type, text) => {
    setMessage({ type, text });
    setTimeout(() => setMessage({ type: "", text: "" }), 3000);
  };

  // Load all entries on mount
  useEffect(() => {
    loadJobs();
  }, []);

  const loadJobs = async () => {
    try {
      setLoading(true);
      const response = await fetch(`${API_BASE_URL}/entries`);
      const data = await response.json();
      setEntries(data);
    } catch (error) {
      console.error("Error loading jobs:", error);
      showMessage("error", "Failed to load jobs");
    } finally {
      setLoading(false);
    }
  };

  const applyForJob = (entryId, jobId) => {
    window.location.href = `${BASE_URL}/apply/${entryId}/${jobId}`;
  };

  const canApply = (job) => {
    // If job has no division restriction, anyone can apply
    if (!job.division || job.division === "") {
      return true;
    }
    // If job has division restriction, check if user's division matches
    return userDivision === job.division;
  };

  const isJobFull = (job) => {
    const appliedCount = job.persons?.length || 0;
    return appliedCount >= job.need;
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-green-50 to-blue-100 p-6">
      <div className="max-w-7xl mx-auto">
        {/* Message Toast */}
        {message.text && (
          <div
            className={`fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 ${
              message.type === "success" ? "bg-green-500" : "bg-red-500"
            } text-white`}
          >
            {message.text}
          </div>
        )}

        {/* Header */}
        <div className="bg-white rounded-lg shadow-lg p-6 mb-6">
          <div className="flex justify-between items-center">
            <div>
              <h1 className="text-sm md:text-3xl font-bold text-gray-800">
                Berbagi Bites Jogja - Slot Volunteer
              </h1>
              <p className="text-xs md:text-sm text-gray-600 mt-1">
                Ayo isi kesediaan sebelum penuh
              </p>
            </div>
            <button
              onClick={loadJobs}
              disabled={loading}
              className="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition disabled:opacity-50"
            >
              <RefreshCw size={20} className={loading ? "animate-spin" : ""} />
              Refresh
            </button>
          </div>

          {/* Division Filter */}
          <div className="mt-4 bg-gray-50 rounded-lg p-4 border border-gray-200">
            <label className="block text-sm font-medium text-gray-700 mb-2">
              Your Division (for filtering restricted jobs)
            </label>
            <input
              type="text"
              value={userDivision}
              onChange={(e) => setUserDivision(e.target.value)}
              placeholder="e.g., Friend, Food, Medinfo"
              className="w-full md:w-96 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
            <p className="text-xs text-gray-500 mt-2">
              💡 Enter your division to see jobs available for you
            </p>
          </div>
        </div>

        {/* Job Entries */}
        {loading ? (
          <div className="bg-white rounded-lg shadow-lg p-12 text-center">
            <RefreshCw
              size={48}
              className="animate-spin text-blue-500 mx-auto mb-4"
            />
            <p className="text-gray-500">Loading jobs...</p>
          </div>
        ) : entries.length === 0 ? (
          <div className="bg-white rounded-lg shadow-lg p-12 text-center">
            <p className="text-gray-500 text-lg">
              No job openings available at the moment.
            </p>
          </div>
        ) : (
          entries.map((entry) => (
            <div
              key={entry.id}
              className="bg-white rounded-lg shadow-lg p-6 mb-6"
            >
              {/* Entry Header */}
              <div className="border-b border-gray-200 pb-4 mb-4">
                <div className="flex items-center justify-between mb-2">
                  <h2 className="text-sm md:text-2xl font-bold text-gray-800">
                    {entry.sponsor} → {entry.receiver}
                  </h2>
                  <span className="text-sm bg-blue-100 text-blue-800 px-3 py-1 rounded-full">
                    #{entry.id}
                  </span>
                </div>
                <div className="flex items-center gap-2 text-gray-600">
                  <Calendar size={16} />
                  <span className="text-sm">{entry.date}</span>
                </div>
              </div>

              {/* Jobs Grid */}
              <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                {entry.jobs.map((job) => {
                  const appliedCount = job.persons?.length || 0;
                  const remainingSlots = job.need - appliedCount;
                  const isFull = isJobFull(job);
                  const canUserApply = canApply(job);
                  const isRestricted = job.division && job.division !== "";

                  return (
                    <div
                      key={job.id}
                      className={`border-2 rounded-lg p-4 transition-all ${
                        isFull
                          ? "border-gray-300 bg-gray-50"
                          : canUserApply
                          ? "border-blue-200 bg-blue-50 hover:border-blue-400 hover:shadow-md"
                          : "border-red-200 bg-red-50"
                      }`}
                    >
                      {/* Job Header */}
                      <div className="mb-3">
                        <div className="flex items-center justify-between mb-2">
                          <h3 className="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <Briefcase size={18} />
                            {job.name}
                          </h3>
                          {isFull && (
                            <span className="text-xs bg-gray-500 text-white px-2 py-1 rounded">
                              FULL
                            </span>
                          )}
                        </div>

                        <div className="flex items-center gap-2 text-gray-600 text-sm mb-2">
                          <MapPin size={14} />
                          <span>{job.place}</span>
                        </div>

                        {/* Division Badge */}
                        {isRestricted ? (
                          <div className="flex items-center gap-2 mb-2">
                            <Lock size={14} className="text-purple-600" />
                            <span className="text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded font-medium">
                              Restricted: {job.division}
                            </span>
                          </div>
                        ) : (
                          <div className="flex items-center gap-2 mb-2">
                            <Globe size={14} className="text-green-600" />
                            <span className="text-xs bg-green-100 text-green-800 px-2 py-1 rounded font-medium">
                              Open to all
                            </span>
                          </div>
                        )}

                        {/* Slots Info */}
                        <div className="flex items-center gap-2 bg-white rounded-lg p-2 border border-gray-200">
                          <Users size={16} className="text-blue-600" />
                          <div className="flex-1">
                            <div className="flex justify-between items-center">
                              <span className="text-sm font-medium text-gray-700">
                                {appliedCount} / {job.need} Applied
                              </span>
                              {remainingSlots > 0 && (
                                <span className="text-xs text-orange-600 font-medium">
                                  {remainingSlots} left
                                </span>
                              )}
                            </div>
                            <div className="w-full bg-gray-200 rounded-full h-2 mt-1">
                              <div
                                className={`h-2 rounded-full transition-all ${
                                  isFull ? "bg-green-500" : "bg-blue-500"
                                }`}
                                style={{
                                  width: `${(appliedCount / job.need) * 100}%`,
                                }}
                              />
                            </div>
                          </div>
                        </div>
                      </div>

                      {/* Apply Button */}
                      {isFull ? (
                        <button
                          disabled
                          className="w-full bg-gray-400 text-white py-2 px-4 rounded-lg font-medium cursor-not-allowed"
                        >
                          Position Filled
                        </button>
                      ) : !canUserApply ? (
                        <div className="w-full bg-red-100 border border-red-300 text-red-800 py-2 px-4 rounded-lg font-medium text-center text-sm">
                          ⚠️ Not available for your division
                        </div>
                      ) : (
                        <button
                          onClick={() => applyForJob(entry.id, job.id)}
                          className="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg font-medium transition flex items-center justify-center gap-2"
                        >
                          Apply Now
                          <ExternalLink size={16} />
                        </button>
                      )}

                      {/* Applied Users (if any) */}
                      {appliedCount > 0 && (
                        <div className="mt-3 pt-3 border-t border-gray-200">
                          <p className="text-xs text-gray-600 mb-2 font-medium">
                            Applied by:
                          </p>
                          <div className="space-y-1">
                            {job.persons.slice(0, 3).map((person, idx) => (
                              <div
                                key={idx}
                                className="text-xs text-gray-700 bg-white px-2 py-1 rounded"
                              >
                                • {person.name}
                              </div>
                            ))}
                            {appliedCount > 3 && (
                              <div className="text-xs text-gray-500 italic">
                                +{appliedCount - 3} more
                              </div>
                            )}
                          </div>
                        </div>
                      )}
                    </div>
                  );
                })}
              </div>
            </div>
          ))
        )}
      </div>
    </div>
  );
}
