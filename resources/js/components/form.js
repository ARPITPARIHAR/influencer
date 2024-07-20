import { useState } from 'react';
import '../App.css';
import PersonIcon from '@mui/icons-material/Person';

function Form() {
  const [image, setImage] = useState("");
  const [fileName, setFileName] = useState("No selected file");
  const [formData, setFormData] = useState({
    firstName: '',
    lastName: '',
    email: '',
    contactNumber: '',
    socialMediaHandles: {
      facebook: false,
      instagram: false,
      twitter: false,
      youtube: false,
      tiktok: false,
      snapchat: false,
    },
    contentType: [],
    other: '',
    additionalContentTypes: [],
  });

  const handleChange = (e) => {
    const { name, type, checked, value } = e.target;
    if (type === 'checkbox' && Object.keys(formData.socialMediaHandles).includes(name)) {
      setFormData((prevData) => ({
        ...prevData,
        socialMediaHandles: {
          ...prevData.socialMediaHandles,
          [name]: checked,
        },
      }));
    } else {
      setFormData((prevData) => ({
        ...prevData,
        [name]: value,
      }));
    }
  };

  const handleContentTypeChange = (e) => {
    const { value } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      contentType: prevData.contentType.includes(value)
        ? prevData.contentType.filter((type) => type !== value)
        : [...prevData.contentType, value],
    }));
  };

  const handleAddContentType = () => {
    setFormData((prevData) => ({
      ...prevData,
      additionalContentTypes: [...prevData.additionalContentTypes, prevData.other],
      other: '',
    }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log('Form data:', formData);
  };

  const handleFileChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      setFileName(file.name);
      setImage(URL.createObjectURL(file));
    }
  };

  return (
    <>
    <div className='background flex justify-center items-center'>
    <div className="container mx-auto my-5 p-[3rem] h-auto sm:w-[60%] border border-black rounded-3xl shadow-slate-500 shadow-[10px_10px_10px_0] ">
      <h1 className="text-4xl font-bold text-black mb-4 text-center">INFLUENCER FORM</h1>
      <hr />
      <form onSubmit={handleSubmit}>
      <main className='flex justify-center'>
        <form  className='flex justify-center items-center cursor-pointer h-[200px] w-[200px] bg-gray-300 rounded-full m-7' >
          <input
            type="file"
            accept='image/*'
            name="image"
            hidden
            id="fileInput"
            onChange={handleFileChange}
          />
          <label htmlFor="fileInput" className='cursor-pointer'>
            {image ? (
              <img className='h-[200px] w-[200px]' src={image} alt="" />
            ) : (
              <span className="text-gray-500">
                <PersonIcon sx={{ fontSize: "5rem" }} />
              </span>
            )}
          </label>
        </form>
      </main>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
          <div>
            <label htmlFor="firstName" className="block text-black text-3xl font-bold mb-2">
              First Name
            </label>
            <input
              type="text"
              id="firstName"
              name="firstName"
              value={formData.firstName}
              onChange={handleChange}
              required
              className=" input shadow appearance-none border border-white rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
            />
          </div>
          <div>
            <label htmlFor="lastName" className="block text-black text-3xl font-bold mb-2">
              Last Name
            </label>
            <input
              type="text"
              id="lastName"
              name="lastName"
              value={formData.lastName}
              onChange={handleChange}
              required
              className="input shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
            />
          </div>
        </div>
        <div className="mb-4">
          <label htmlFor="email" className="block text-black text-3xl font-bold mb-2 mt-2">
            Email
          </label>
          <input
            type="email"
            id="email"
            name="email"
            value={formData.email}
            onChange={handleChange}
            required
            className=" input shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
          />
        </div>
        <div className="mb-4">
          <label htmlFor="contactNumber" className="block text-black text-3xl font-bold mb-2 mt-2">
            Contact Number
          </label>
          <input
            type="number"
            id="contactNumber"
            name="contactNumber"
            value={formData.contactNumber}
            onChange={handleChange}
            required
            className=" input shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
          />
        </div>
        <h2 className="text-3xl text-black font-bold mb-2">Social Media Handles</h2>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4 text-xl text-black">
          {Object.keys(formData.socialMediaHandles).map((handle) => (
            <div key={handle}>
              <input
                type="checkbox"
                id={handle}
                name={handle}
                checked={formData.socialMediaHandles[handle]}
                onChange={handleChange}
                className=" input mr-2"
              />
              <label htmlFor={handle}>{handle.charAt(0).toUpperCase() + handle.slice(1)}</label>
              {formData.socialMediaHandles[handle] && (
                <input
                  type="text"
                  name={`${handle}Input`}
                  value={formData[`${handle}Input`] || ''}
                  onChange={(e) =>
                    setFormData((prevData) => ({
                      ...prevData,
                      [`${handle}Input`]: e.target.value,
                    }))
                  }
                  className=" input shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline mt-2"
                  placeholder='Enter Profile Id'
                />
              )}
            </div>
          ))}
        </div>
        <h2 className="text-3xl  text-black font-bold mb-2 pt-3">Content Type</h2>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4 text-xl text-black">
          {['Comedy', 'Motivation', 'Series', 'Movies', 'Vlogs', 'Gaming', 'Animation', 'Education', 'Food Reciepes', 'Rhymes'].map(
            (type) => (
              <div key={type}>
                <input
                  type="checkbox"
                  id={type.toLowerCase()}
                  value={type}
                  checked={formData.contentType.includes(type)}
                  onChange={handleContentTypeChange}
                  className="mr-2"
                />
                <label htmlFor={type.toLowerCase()}>{type}</label>
              </div>
            )
          )}
        </div>
        <div className="mb-4 pt-3">
          <label htmlFor="other" className="block text-black text-2xl font-bold mb-2">
            Add Other Content Type
          </label>
          <div className="flex items-center">
            <input
              type="text"
              id="other"
              name="other"
              value={formData.other}
              onChange={handleChange}
              className="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
              placeholder="Enter other content type"
            />
            <button
              type="button"
              onClick={handleAddContentType}
              className="addbtn hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2"
            >
              Add
            </button>
          </div>
        </div>
        {formData.additionalContentTypes.map((type, index) => (
          <div key={index} className="mb-4">
            <input
              type="text"
              value={type}
              onChange={(e) => {
                const newTypes = [...formData.additionalContentTypes];
                newTypes[index] = e.target.value;
                setFormData((prevData) => ({
                  ...prevData,
                  additionalContentTypes: newTypes,
                }));
              }}
              className="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
              placeholder="Enter other content type"
            />
          </div>
        ))}
        <div className="flex justify-center">
          <button
            type="submit"
            className="submitbtn text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          >
            Submit
          </button>
        </div>
      </form>
    </div>
</div>
    </>


  );
}

export default Form;
