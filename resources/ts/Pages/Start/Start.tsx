import React from "react";

const Start = () => {
    return (
        <>
            <div className="h-screen bg-slate-300 ">
                <div>
                    <h1 className="text-3xl text-center font-extrabold pt-40">
                        <span>Hello! This is a weather API.</span>
                        <br />
                        <span>Prepare query as below:</span>
                    </h1>
                    <h4 className="text-center mt-6">{` ${window.location.hostname}:${window.location.port}/weather-api/[ISO country_code]/[city-name]`}</h4>
                </div>
            </div>
        </>
    );
};
export default Start;
