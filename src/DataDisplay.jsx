import React, { useState, useEffect } from "react";
import {
  Plus,
  Trash2,
  Briefcase,
  Save,
  RefreshCw,
  Users,
  Eye,
} from "lucide-react";

export default function DataDisplay() {
  const [formData, setFormData] = useState([]);
  const [loading, setLoading] = useState(false);
  const [message, setMessage] = useState({ type: "", text: "" });
  const [expandedJobs, setExpandedJobs] = useState({});

  // API Base URL - change this to your Laravel API
  const API_BASE_URL = "https://app.berbagibitesjogja.com/api";

  // Show message helper
  const showMessage = (type, text) => {
    setMessage({ type, text });
    setTimeout(() => setMessage({ type: "", text: "" }), 3000);
  };

  // Load all entries on mount
  useEffect(() => {
    loadEntries();
  }, []);

  const loadEntries = async () => {
    try {
      setLoading(true);
      const response = await fetch(`${API_BASE_URL}/entries`);
      const data = await response.json();
      if (data.length > 0) {
        setFormData(data);
      }
    } catch (error) {
      console.error("Error loading entries:", error);
      showMessage("error", "Failed to load entries");
    } finally {
      setLoading(false);
    }
  };

  const saveAllEntries = async () => {
    try {
      setLoading(true);
      const response = await fetch(`${API_BASE_URL}/entries`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ entries: formData }),
      });

      const savedData = await response.json();
      setFormData(savedData);
      showMessage("success", "All entries saved successfully!");
    } catch (error) {
      console.error("Error saving entries:", error);
      showMessage("error", "Failed to save entries");
    } finally {
      setLoading(false);
    }
  };

  const deleteEntry = async (index) => {
    const entry = formData[index];
    if (entry.id) {
      if (!confirm("Are you sure you want to delete this entry?")) return;

      try {
        setLoading(true);
        await fetch(`${API_BASE_URL}/entries/${entry.id}`, {
          method: "DELETE",
        });
        showMessage("success", "Entry deleted successfully!");
      } catch (error) {
        console.error("Error deleting entry:", error);
        showMessage("error", "Failed to delete entry");
        return;
      } finally {
        setLoading(false);
      }
    }
    setFormData(formData.filter((_, i) => i !== index));
  };

  const addEntry = () => {
    setFormData([
      ...formData,
      {
        id: null,
        date: "",
        sponsor: "",
        receiver: "",
        jobs: [
          {
            id: null,
            name: "",
            need: 2,
            place: "",
            division: "", // empty = open to all, filled = restricted to specific division
            persons: [],
          },
        ],
      },
    ]);
  };

  const updateEntry = (index, field, value) => {
    const updated = [...formData];
    updated[index][field] = value;
    setFormData(updated);
  };

  const addJob = (entryIndex) => {
    const updated = [...formData];
    updated[entryIndex].jobs.push({
      id: null,
      name: "",
      need: 2,
      place: "",
      division: "",
      persons: [],
    });
    setFormData(updated);
  };

  const removeJob = (entryIndex, jobIndex) => {
    const updated = [...formData];
    updated[entryIndex].jobs = updated[entryIndex].jobs.filter(
      (_, i) => i !== jobIndex
    );
    setFormData(updated);
  };

  const updateJob = (entryIndex, jobIndex, field, value) => {
    const updated = [...formData];
    updated[entryIndex].jobs[jobIndex][field] = value;
    setFormData(updated);
  };

  const toggleJobExpand = (entryIndex, jobIndex) => {
    const key = `${entryIndex}-${jobIndex}`;
    setExpandedJobs((prev) => ({
      ...prev,
      [key]: !prev[key],
    }));
  };

  const hasUnsavedChanges = formData.some((entry) => !entry.id);

  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-6">
      <div className="max-w-6xl mx-auto">
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

        {/* Header with Global Save */}
        <div className="bg-white rounded-lg shadow-lg p-6 mb-6">
          <div className="grid grid-cols-1 md:grid-cols-2">
            <div>
              <h1 className="text-sm md:text-3xl font-bold text-gray-800">
                Berbagi Bites Jogja - Slot Manager
              </h1>
              <p className="text-sm text-gray-600 mt-1">
                Atur slot jadwal volunteer mingguan
              </p>
            </div>
            <div className="flex gap-1">
              <button
                onClick={loadEntries}
                disabled={loading}
                className="flex items-center gap-1 bg-gray-600 text-white text-xs md:text-lg px-2 md:px-4 py-1 md:py-2 rounded-lg hover:bg-gray-700 transition disabled:opacity-50"
              >
                <RefreshCw
                  size={20}
                  className={loading ? "animate-spin" : ""}
                />
                Load Data
              </button>
              <button
                onClick={addEntry}
                className="flex items-center gap-1 bg-indigo-600 text-white text-xs md:text-lg px-2 md:px-4 py-1 md:py-2 rounded-lg hover:bg-indigo-700 transition"
              >
                <Plus size={20} />
                Tambah
              </button>
              <button
                onClick={saveAllEntries}
                disabled={loading}
                className="flex items-center gap-1 bg-green-600 text-white text-xs md:text-lg px-2 md:px-4 py-1 md:py-2 rounded-lg hover:bg-green-700 transition disabled:opacity-50 font-bold shadow-lg"
              >
                <Save size={22} />
                Simpan
              </button>
            </div>
          </div>

          {hasUnsavedChanges && (
            <div className="mt-4 bg-yellow-50 border border-yellow-300 rounded-lg p-3">
              <p className="text-sm text-yellow-800 font-medium">
                ⚠️ You have unsaved changes. Click "Save All" to save to
                database.
              </p>
            </div>
          )}
        </div>

        {/* Entries */}
        {formData.map((entry, entryIndex) => (
          <div
            key={entryIndex}
            className="mb-6 border-2 border-gray-200 rounded-lg p-6 bg-white shadow-lg"
          >
            <div className="flex justify-between items-center mb-4">
              <div className="flex items-center gap-3">
                <h2 className="text-sm md:text-xl font-semibold text-gray-700">
                  Jadwal {entryIndex + 1}
                </h2>
                {entry.id ? (
                  <span className="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">
                    {entry.id}
                  </span>
                ) : (
                  <span className="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded font-medium">
                    Not Saved
                  </span>
                )}
              </div>
              <button
                onClick={() => deleteEntry(entryIndex)}
                disabled={loading}
                className="text-xs md:text-md flex items-center gap-1 bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 transition disabled:opacity-50"
              >
                <Trash2 size={18} />
                Delete
              </button>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">
                  Tanggal Kegiatan
                </label>
                <input
                  type="date"
                  value={entry.date}
                  onChange={(e) =>
                    updateEntry(entryIndex, "date", e.target.value)
                  }
                  className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">
                  Donor
                </label>
                <input
                  type="text"
                  value={entry.sponsor}
                  onChange={(e) =>
                    updateEntry(entryIndex, "sponsor", e.target.value)
                  }
                  placeholder="Sponsor name"
                  className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">
                  Kontributor
                </label>
                <input
                  type="text"
                  value={entry.receiver}
                  onChange={(e) =>
                    updateEntry(entryIndex, "receiver", e.target.value)
                  }
                  placeholder="Receiver name"
                  className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                />
              </div>
            </div>

            <div className="bg-gray-50 rounded-lg p-4">
              <div className="flex justify-between items-center mb-4">
                <h3 className="text-sm md:text-lg font-semibold text-gray-700 flex items-center gap-2">
                  <Briefcase size={20} />
                  Slot Volunteer
                </h3>
                <button
                  onClick={() => addJob(entryIndex)}
                  className="flex items-center gap-1 bg-green-500 text-white px-2 md:px-3 py-1 rounded-lg hover:bg-green-600 transition text-sm"
                >
                  <Plus size={16} />
                  Tambah
                </button>
              </div>

              {entry.jobs.length === 0 && (
                <div className="text-center py-8 text-gray-500 bg-white rounded-lg">
                  No jobs added yet. Click "Add Job" to create a job opening.
                </div>
              )}

              {entry.jobs.map((job, jobIndex) => {
                const isExpanded = expandedJobs[`${entryIndex}-${jobIndex}`];
                const appliedCount = job.persons?.length || 0;
                const remainingSlots = job.need - appliedCount;

                return (
                  <div
                    key={jobIndex}
                    className="border border-gray-200 rounded-lg p-4 mb-3 bg-white"
                  >
                    <div className="flex justify-between items-start mb-3">
                      <div className="flex-1">
                        <div className="flex items-center gap-2 mb-3">
                          <h4 className="text-sm md:text-md font-medium text-gray-700">
                            Tugas {jobIndex + 1}
                          </h4>
                          {job.id && (
                            <span className="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">
                              #{job.id}
                            </span>
                          )}
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-4 gap-3 mb-3">
                          <div>
                            <label className="block text-xs font-medium text-gray-600 mb-1">
                              Deskripsi
                            </label>
                            <input
                              type="text"
                              value={job.name}
                              onChange={(e) =>
                                updateJob(
                                  entryIndex,
                                  jobIndex,
                                  "name",
                                  e.target.value
                                )
                              }
                              placeholder="e.g., Driver, Security"
                              className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm"
                            />
                          </div>
                          <div>
                            <label className="block text-xs font-medium text-gray-600 mb-1">
                              Jumlah Slot
                            </label>
                            <input
                              type="number"
                              value={job.need}
                              onChange={(e) =>
                                updateJob(
                                  entryIndex,
                                  jobIndex,
                                  "need",
                                  parseInt(e.target.value) || 0
                                )
                              }
                              min="1"
                              className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm"
                            />
                          </div>
                          <div>
                            <label className="block text-xs font-medium text-gray-600 mb-1">
                              Jam dan Tempat
                            </label>
                            <input
                              type="text"
                              value={job.place}
                              onChange={(e) =>
                                updateJob(
                                  entryIndex,
                                  jobIndex,
                                  "place",
                                  e.target.value
                                )
                              }
                              placeholder="Work location"
                              className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm"
                            />
                          </div>
                          <div>
                            <label className="block text-xs font-medium text-gray-600 mb-1">
                              Divisi (opsional)
                            </label>
                            <input
                              type="text"
                              value={job.division || ""}
                              onChange={(e) =>
                                updateJob(
                                  entryIndex,
                                  jobIndex,
                                  "division",
                                  e.target.value
                                )
                              }
                              placeholder="Leave empty for all"
                              className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm"
                            />
                          </div>
                        </div>

                        {/* Applicants Summary */}
                        <div className="flex items-center gap-3 flex-wrap">
                          <div className="flex items-center gap-2 bg-blue-50 px-3 py-2 rounded-lg">
                            <Users size={16} className="text-blue-600" />
                            <span className="text-sm font-medium text-blue-900">
                              {appliedCount} / {job.need} Applied
                            </span>
                          </div>

                          {remainingSlots > 0 && (
                            <span className="text-xs bg-orange-100 text-orange-800 px-2 py-1 rounded">
                              {remainingSlots} slots remaining
                            </span>
                          )}

                          {remainingSlots === 0 && appliedCount > 0 && (
                            <span className="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">
                              ✓ Fully staffed
                            </span>
                          )}

                          {appliedCount > 0 && (
                            <button
                              onClick={() =>
                                toggleJobExpand(entryIndex, jobIndex)
                              }
                              className="flex items-center gap-1 text-sm text-indigo-600 hover:text-indigo-800 font-medium"
                            >
                              <Eye size={14} />
                              {isExpanded ? "Hide" : "View"} Applicants
                            </button>
                          )}
                        </div>

                        {/* Applicants List (Read-only) */}
                        {isExpanded && appliedCount > 0 && (
                          <div className="mt-3 bg-gray-50 rounded-lg p-3 border border-gray-200">
                            <h5 className="text-xs font-semibold text-gray-700 mb-2">
                              Applicants:
                            </h5>
                            <div className="space-y-2">
                              {job.persons.map((person, personIndex) => (
                                <div
                                  key={personIndex}
                                  className="flex items-center justify-between bg-white p-2 rounded border border-gray-200"
                                >
                                  <div className="grid grid-cols-1 md:grid-cols-2 items-center gap-3">
                                    <span className="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded font-medium">
                                      #{personIndex + 1}
                                    </span>
                                    <div>
                                      <p className="text-sm font-medium text-gray-800">
                                        {person.name}
                                      </p>
                                      <p className="text-xs text-gray-600">
                                        {person.phone}
                                      </p>
                                    </div>
                                  </div>
                                  {person.id && (
                                    <span className="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">
                                      ID: {person.id}
                                    </span>
                                  )}
                                </div>
                              ))}
                            </div>
                          </div>
                        )}
                      </div>

                      <button
                        onClick={() => removeJob(entryIndex, jobIndex)}
                        className="ml-3 text-red-500 hover:text-red-700 transition"
                      >
                        <Trash2 size={16} />
                      </button>
                    </div>
                  </div>
                );
              })}
            </div>
          </div>
        ))}

        {formData.length === 0 && (
          <div className="bg-white rounded-lg shadow-lg p-12 text-center">
            <p className="text-gray-500 text-lg">
              No entries yet. Click "Add Entry" to get started.
            </p>
          </div>
        )}
      </div>
    </div>
  );
}
