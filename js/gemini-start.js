
import { GoogleGenerativeAI } from "@google/generative-ai";

// // dotenv.config();
const API_KEY="AIzaSyASORHXl-kPxtGNAnFnF9MB_GVo1G3zR7k";
const genAI = new GoogleGenerativeAI(API_KEY);

const args = process.argv.slice(2);
// console.log(`Hello, ${args[0]}! Your favorite dish is ${args[1]}.`);    

async function run(args){
    const model = genAI.getGenerativeModel({model: "gemini-2.0-flash"});
    const prompt = `I will be giving you the text of a resume...Give me info about the follwing in a json format... {name:,phone no:, email:, technologies_used:,skills:}...give as plain json..add no asterisks ${args[0]}`;
    const result = await model.generateContent(prompt);
    const response = await result.response;
    // console.log(response);
    const text = await response.text();
    console.log('hii')
    // return text;    

}
run(args);