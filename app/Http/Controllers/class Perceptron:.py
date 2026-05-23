class Perceptron:
    
    def __init__(self):
        
        self.weights = None

    def fit_single_epoch(self, data, labels, weights, step_size=1, verbose = False):
        """ 
        Train a linear perceptron by iterating exactly once over the data.

        PARAMETERS
        ----------

        data       A numpy array of real values with n rows and d columns, where n
                   is the number of data points and d is the number of dimensions.

        labels     A vector containing labels drawn from {1,-1}. The jth label
                   is the label of the jth example data point in data.

        weights    A vector of d+1 weights for a 1950's style perceptron, where d is 
                   the number of dimensions of the data

        step_size  A positive real value in the range 0 < step_size <= 1

        verbose    If true, it will print out its calculations after every
                   looking at each data point

        RETURNS
        -------
        converged  Set to 1 if a line that separated the two classes was found. 
                   Else it is set to 0.

        weights    A vector of d+1 weights that characterize the hyperplane that
                   separates the data (if it convereged). If data has 3 dimensions, 
                   then weights will have 4 elements. The first element is the 
                   bias (aka offset), the remaining weights correspond to the weight
                   associated with each of the 3 dimensions of the data.
        """

        # To do the perceptron algorithm, add a column of ones to the data, these
        # will correspond to the bias.
        num_points,num_dimensions = np.shape(data)
        b = np.ones(num_points)
        bias = np.expand_dims(b,axis=1)
        data_plus = np.append(bias,data,axis=1)

        converged = 1; # we're being optimistic.

        # iterate over every element in the data
        for n in range(0,num_points):
          point = data_plus[n]
          label = labels[n]

          # this is where the perceptron classifies
          estimated_label = np.sign(np.sum(np.multiply(weights,point)))

          if verbose:
            print(' point = ', point, '  label = ', label, ' estimated_label = ', estimated_label)
            print('old weights = ', np.round(weights, 3))

          # This is where the perceptron updates
          if (estimated_label != label):
            converged=0  # admit we haven't converged 
            weights = weights + (step_size * label * point) #change the weights of the hyperplane
            if verbose: print('new weights = ', np.round(weights, 3))

        return converged, weights  

    def fit(self, 
            data: np.ndarray, 
            labels: np.ndarray, 
            step_size: float = 1.0, 
            max_iter: int = 10,
            verbose: bool = False):
        """ 
        Train a linear perceptron by iterating over the data until an iteration
        limit is reached or the model converges.

        PARAMETERS
        ----------

        data       A numpy array of real values with n rows and d columns, where n
                   is the number of data points and d is the number of dimensions.

        labels     A vector containing labels drawn from {1,-1}. The jth label
                   is the label of the jth example data point in data.

        step_size  A positive real value in the range 0 < step_size <= 1
        
        max_iter   The maximum number of iterations to perform

        verbose    If true, it will print out its calculations after every
                   looking at each data point
        """
        
        # set the weights of the perceptron to an inital set of random values, 
        # and make sure to include "extra" bias weight
        if self.weights is None:
            n_features = data.shape[-1]
            weights = np.random.rand(1, n_features + 1)
        else:
            weights = self.weights
        
        for _ in range(max_iter):
            
            converged, weights = self.fit_single_epoch(data, labels, weights, step_size, verbose)
            
            if converged:
                break
                
        # store learned weights
        self.weights = weights
    
    def predict(self, data: np.ndarray):
        """ 
        This predicts a label (+1 or -1) for each example in the data and returns 
        predictions as a numpy array.

        PARAMETERS
        ----------

        data     A numpy array of real values with n rows and d columns, where n
                 is the number of data points and d is the number of dimensions.
                 Each row is a data point to be classiified.

        RETURNS
        -------
        A vector with n labels drawn from (+1 or -1), where the ith
        label is the predicted label of the ith data point 
        """
        
        # To do the perceptron algorithm, add a column of ones to the data, these
        # will correspond to the bias.
        num_points,num_dimensions = np.shape(data)
        b = np.ones(num_points)
        bias = np.expand_dims(b,axis=1)
        data_plus = np.append(bias,data,axis=1)

        # now predict classes
        class_prediction = np.zeros(num_points)
        for n in range(0,num_points):
            point = data_plus[n]
            class_prediction[n] = np.sign(np.sum(np.multiply(self.weights, point)))

        return class_prediction


    def __call__(self, data: np.ndarray):
        return self.predict(data)