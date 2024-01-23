# Image Chatbot Project

This project implements an image chatbot using Laravel, ChatGPT API, and image processing libraries.

## Table of Contents

1. [Introduction](#introduction)
2. [Features](#features)
3. [Prerequisites](#prerequisites)
4. [Installation](#installation)
5. [Usage](#usage)
6. [Design Choices](#design-choices)
7. [Challenges Faced](#challenges-faced)
8. [Error Handling](#error-handling)
9. [Feedback Mechanism](#feedback-mechanism)
10. [Documentation](#documentation)
11. [License](#license)

## Introduction

The purpose of the image chatbot project is to create an interactive application that allows users to engage in conversations with a chatbot through a user-friendly interface. The key functionality of the project includes:

1. **Image Uploads:** Users can upload images through the application.

2. **Chatbot Interaction:** The application interacts with the ChatGPT API to generate responses based on user inputs and uploaded images.

3. **Error Handling:** The project implements robust error handling mechanisms, addressing issues related to image uploads and interactions with the ChatGPT API.

4. **User Feedback System:** Users have the ability to provide feedback on the responses generated by the chatbot.

5. **Conversation History:** The application stores and displays a history of user interactions and chatbot responses.

The goal is to create a seamless and intuitive experience for users to engage in meaningful conversations with the chatbot, leveraging the capabilities of ChatGPT and incorporating image processing for a richer interaction. The project aims to provide clear documentation, handle errors gracefully, and offer a user-friendly interface for both image uploads and textual inputs.

## Features

- Upload images and interact with a chatbot.
- Integration with the ChatGPT API for generating responses.
- Error handling mechanisms for image uploads and API interactions.
- User feedback system.

## Prerequisites

- Laravel 10 framework
- ChatGPT API key
- Image processing library (e.g., Intervention Image)
- PHP 7.4 or later

## Installation

1. Clone the repository.
2. Install dependencies: `composer install`
3. Copy the `.env.example` file to `.env` and configure your environment variables.
4. Migrate the database: `php artisan migrate` and run the user seeder `php artisan db:seed --class=UsersTableSeeder` (this is very important)
5. Run the application: `php artisan serve`

## Usage

## Using the Image Chatbot Application:

### 1. **Accessing the Application:**
   - Navigate to the web application using the provided URL or run the application locally, e.g localhost/login.

### 2. **User Registration/Login:**
   - If required, register for a new account or log in with existing credentials.

### 3. **Image Upload:**
   - On the main dashboard, find the image upload section.
   - Click on the designated area or button to upload an image.
   - Supported formats: JPEG, PNG, JPG, GIF.

### 4. **Chatbot Interaction:**
   - Enter text in the chat input field to communicate with the chatbot.
   - The chatbot utilizes ChatGPT API to generate responses based on the provided input and the uploaded image.

### 5. **Conversation History:**
   - View the conversation history to see a thread of interactions between the user and the chatbot.
   - Each message includes the user's input or uploaded image and the corresponding chatbot response.

### 6. **Clearing Chat History:**
   - If conversation history exists, a "Clear Chat" button is available.
   - Clicking this button will clear the entire conversation history.

### 7. **Providing Feedback:**
   - Users can provide feedback on chatbot responses.
   - Access the feedback section and submit feedback based on the conversation.

### 8. **Error Handling:**
   - If an error occurs during image upload or ChatGPT API interaction, users will receive appropriate error messages.
   - Error messages are displayed to guide users on resolving issues.

### 9. **Logging Out:**
   - Log out of the application when done using the provided logout functionality.

### 10. **Documentation:**
   - Refer to the application's README.md for detailed instructions on setting up, running, and understanding the design choices.
   - The README.md also provides insights into any challenges faced during development and how to handle errors.

By following these steps, users can seamlessly interact with the image chatbot, leverage its capabilities, and enjoy a dynamic conversation experience combining text and image inputs.

## Design Choices

#### **Laravel Framework:**
Laravel was chosen as the framework for several reasons:

- **Elegance and Simplicity:** Laravel offers an elegant syntax and provides a clean and expressive way to define routes, create models, and handle database migrations. This simplicity contributes to faster development.

- **Rich Ecosystem:** Laravel comes with a rich ecosystem and a set of tools that make common tasks, such as routing, caching, and authentication, straightforward. This allows developers to focus on building features rather than dealing with boilerplate code.

- **Community Support:** Laravel has a large and active community. This community support ensures that developers have access to a wealth of resources, tutorials, and packages, making it easier to troubleshoot issues and stay updated on best practices.

- **Modern Features:** Laravel incorporates modern features like Eloquent ORM, Blade templating engine, and Laravel Mix for asset compilation. These features enhance the developer experience and code maintainability.

#### **Image Processing Library (Intervention Image):**
Intervention Image was selected for handling image uploads and processing due to its simplicity, efficiency, and feature-rich capabilities:

- **Ease of Use:** Intervention Image provides a simple and intuitive API for image manipulation. Developers can easily perform tasks like resizing, cropping, and encoding with just a few lines of code.

- **Extensive Documentation:** The library has extensive documentation, making it easy for developers to understand its functionalities and quickly implement image processing features in the application.

- **Active Maintenance:** Intervention Image is actively maintained and receives updates. This ensures compatibility with the latest PHP versions and security patches, providing a reliable solution for image processing needs.

#### **ChatGPT Integration:**
The design decisions regarding communication with the ChatGPT API include:

- **Guzzle HTTP Client:** Guzzle, a widely used HTTP client for PHP, was employed to handle communication with the ChatGPT API. Guzzle simplifies the process of sending HTTP requests and handling responses.

- **Middleware for Authorization:** The implementation uses middleware to ensure that only authenticated users can access certain functionalities, such as viewing conversation history.

- **Feedback Mechanism:** A feedback system was integrated to allow users to provide insights into the chatbot responses. This enhances user engagement and helps in refining the chatbot's performance over time.

These design choices aim to strike a balance between simplicity, efficiency, and maintainability, providing a solid foundation for building a responsive and user-friendly image chatbot application.

## Challenges Faced


#### **Challenge 1: Integration with ChatGPT API**
**Description:** Establishing a seamless integration with the ChatGPT API posed challenges, particularly in formatting requests and handling responses.

**Resolution:** In-depth exploration of the ChatGPT API documentation and leveraging Guzzle for HTTP requests helped overcome these challenges. Rigorous testing and debugging were crucial to ensuring the correct structure of requests and proper handling of responses.

---

#### **Challenge 2: Image Processing and Storage**
**Description:** Efficiently processing and storing images while ensuring optimal performance and user experience presented challenges.

**Resolution:** Intervention Image library was selected for image processing due to its simplicity and capabilities. Laravel's storage system facilitated organized image storage, and the public disk was used to serve images. Proper error handling and validation ensured a smooth image processing workflow.

---

#### **Challenge 3: User Feedback Mechanism**
**Description:** Implementing a user feedback system and integrating it seamlessly into the application raised considerations for user experience and data integrity.

**Resolution:** A dedicated Feedback model and migration were created. The system allowed users to submit feedback on chatbot responses. Laravel's validation and eloquent relationships ensured data integrity, and the feedback form was designed to provide a user-friendly experience.

---

#### **Challenge 4: Error Handling**
**Description:** Implementing robust error handling for various scenarios, including image uploads, API interactions, and general application errors, required careful consideration.

**Resolution:** Laravel's exception handling, combined with custom error messages and logging using the Log facade, provided a comprehensive solution. Specific error messages were designed to guide users, and detailed logs assisted in debugging and resolving issues during development and deployment.

---

#### **Challenge 5: User Authentication Middleware**
**Description:** Restricting access to certain functionalities, like viewing conversation history, to authenticated users required the implementation of middleware.

**Resolution:** Laravel's built-in middleware functionality was leveraged to ensure that only authenticated users could access specific routes. This added a layer of security and controlled user access to sensitive information.

---

#### **Challenge 6: Displaying Validation Errors on Blade Views**
**Description:** Displaying specific validation error messages on the Blade views for user interaction proved challenging.

**Resolution:** By utilizing Laravel's validation messages and error bag, along with Blade directives, the specific error messages were successfully displayed on the views, providing users with clear feedback about validation issues.

---

Each challenge was addressed through a combination of research, testing, and leveraging Laravel's features, resulting in a robust and functional image chatbot application.


## Feedback Mechanism

Users can provide feedback on chatbot responses. Refer to the [Feedback Documentation](#feedback-documentation) section for details.

## Documentation

### Challenges Faced

Document challenges encountered during development and their resolutions.

### Error Handling Documentation


Error handling in the Image Chatbot application is a crucial aspect to ensure a smooth user experience and provide meaningful feedback. The application addresses various types of errors, including image upload errors, ChatGPT API interaction errors, and general application errors.

#### **1. Image Upload Errors:**
Errors during image uploads are handled through Laravel's validation and exception handling mechanisms.

- **Validation Rules:** Before processing an image upload, the application validates that the uploaded file is an image with specific mime types and does not exceed a specified size.
  
  ```php
  $request->validate([
      'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
  ]);
  ```

- **Exception Handling:** If an error occurs during the image upload process, a custom exception is thrown, capturing the error details and providing a user-friendly message.

  ```php
  try {
      // Image upload logic
  } catch (\Exception $e) {
      return back()->with('error', 'Image upload failed: ' . $e->getMessage());
  }
  ```

#### **2. ChatGPT API Interaction Errors:**
Errors arising from interactions with the ChatGPT API are meticulously handled to ensure proper communication and user feedback.

- **Exception Handling:** Guzzle, a popular HTTP client for Laravel, is used to make requests to the ChatGPT API. In case of API errors (e.g., HTTP 400 or 500 responses), Guzzle's exception handling is utilized to capture the error details.

  ```php
  try {
      $response = $client->post($apiUrl, $options);
  } catch (\Exception $e) {
      return [
          'error' => 'ChatGPT API error: ' . $e->getMessage(),
      ];
  }
  ```

- **Logging:** Detailed logs are generated using Laravel's Log facade, capturing the complete exception details. This aids in debugging and resolving issues efficiently.

  ```php
  Log::error('ChatGPT API error:', ['exception' => $e]);
  ```

#### **3. General Application Errors:**
For general application errors, Laravel's built-in exception handling and logging features are harnessed.

- **Exception Handling:** Custom error messages and redirects are employed to guide users when unexpected errors occur.

  ```php
  try {
      // Application logic
  } catch (\Exception $e) {
      return back()->with('error', 'An error occurred: ' . $e->getMessage());
  }
  ```

- **Logging:** The Log facade is used to log error details, helping developers identify and resolve issues efficiently.

  ```php
  Log::error('Application error:', ['exception' => $e]);
  ```

By combining validation rules, exception handling, user-friendly messages, and detailed logging, the Image Chatbot application provides a robust error handling mechanism, enhancing user experience and aiding in application maintenance.

### Feedback Documentation

User feedback is a valuable aspect of the Image Chatbot application, allowing users to provide insights on chatbot responses. Follow these instructions to submit feedback:

1. **Conversation View:**
   - Navigate to the conversation view of the Image Chatbot application.

2. **View Chatbot Responses:**
   - Observe the responses provided by the ChatGPT-powered chatbot in the conversation thread.

3. **Feedback Form:**
   - At the top of your conversation you will find a 'Provide Feedback on your experience' link which takes you to the feedback form.

4. **Select Feedback:**
   - Choose from predefined feedback options, such as "Positive," "Neutral," or "Negative," based on your assessment of the chatbot's response.

5. **Optional Comment:**
   - Optionally, you can provide additional comments or specific details regarding your feedback in the text comment box.

6. **Submit Feedback:**
   - Click the "Submit Feedback" button to send your feedback to the application.

7. **Feedback Submission Confirmation:**
   - Upon successful submission, you will receive a confirmation message, acknowledging that your feedback has been recorded.

8. **View Historical Feedback:**
   - If needed, you can access a history of your feedback submissions through a dedicated feedback page or a personalized dashboard.

By following these steps, users can actively participate in enhancing the performance and effectiveness of the chatbot by providing valuable feedback on individual responses. The feedback mechanism serves as a valuable tool for continuous improvement and optimization of the chatbot's capabilities.

## License

This project is licensed under the [MIT License](LICENSE).
